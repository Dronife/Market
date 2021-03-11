<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Events\CreatedNewCheapestItem;
use App\Events\CatchChangesEvent;
use App\Jobs\ProcessItem;
use App\helper\HeapSort;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class anItem
{

    private $name = "";
    private $price = 0;
    private $user_id = -1;
    private $parameters = [
        'name' => '',
        'price' => 0,
        'user_id' => -1
        ];

    public function __construct($request = null)
    {
        if ($request != null) {
            $this->parameters = ['name'=>$request['name'], 'price' =>$request['price']];
        }
        $this->parameters['user_id'] = Auth::user()->id;
    }


    public function Create()
    {

        $newItem = null;

        DB::beginTransaction();
        $doesItemExists = Item::lockForUpdate()->firstOrNew(
            ['name' =>  $this->parameters['name']]
        );
        $newItem = ($doesItemExists->exists)
            ? anItem::Update($doesItemExists->id)
            : Item::create( $this->parameters);
        DB::commit();
        event(new CatchChangesEvent());

        anItem::checkIfItemIsCheapest($newItem);


        return $newItem;
    }

    public function Update($id)
    {
        $item = Item::find($id);
        if ((string)$item->updated_at != (string)Carbon::now() && $item->price !=  $this->parameters['price']) {
            $item->Update( $this->parameters);
        }
        return $item;
    }
    public function CasualUpdate($id)
    {
        $item = Item::find($id);
        if ($item->user_id ==  $this->parameters['user_id']){
            $item->Update( $this->parameters);
        }

        return $item;
    }
    public function delete($ids)
    {

        if (count($ids) > 0) {
            $id = array_pop($ids);
            $item = Item::find($id);
            if ($item->user_id ==  $this->parameters['user_id']) {
                $item->delete();
                anItem::delete($ids);
            }
        } else
            return;
    }


    public function checkIfItemIsCheapest($newItem)
    {
        $firstItem = (new HeapSort)->GetFirst();
        if ($firstItem[0]->id == $newItem->id) {
            event(new CreatedNewCheapestItem($newItem));
        }
    }
}

class ItemFactory
{
    public static function create($request)
    {
        return (new anItem($request))->Create();
    }
    public static function update( $request, $id)
    {
        return (new anItem($request))->CasualUpdate($id);
    }
    public static function destroy($ids)
    {
        return (new anItem())->delete($ids);
    }
}
