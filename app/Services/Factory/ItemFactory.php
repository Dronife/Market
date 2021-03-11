<?php

namespace App\Services\Factory;

use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use App\Events\CreatedNewCheapestItem;
use App\Events\CatchChangesEvent;
use App\Services\HeapSort;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class anItem
{
    //Local variables
    private $parameters = [
        'name' => '',
        'price' => 0,
        'user_id' => -1
        ];
    //Constructor to set local variables
    public function __construct($request = null)
    {
        if ($request != null) {
            $this->parameters = ['name'=>$request['name'], 'price' =>$request['price']];
        }
        $this->parameters['user_id'] = Auth::user()->id;
    }

    //Create event
    public function Create()
    {
        //Like in parallel programming there are lock
        //there is an lock dedicated to databases
        //so there would not be any race conditions
        DB::beginTransaction();
        
        $doesItemExists = Item::lockForUpdate()->firstOrNew(
            ['name' =>  $this->parameters['name']]
        );
        $newItem = ($doesItemExists->exists)
            ? anItem::Update($doesItemExists->id)
            : Item::create( $this->parameters);
        //Unlock the access to database
        DB::commit();
        
        //lets catch an event that new item has been add/updated
        event(new CatchChangesEvent());
        //Lets check is item is cheapest
        anItem::checkIfItemIsCheapest($newItem);


        return $newItem;
    }

    public function Update($id)
    {
        $item = Item::find($id);
        //Lets say if there are few people who want to add new item with same exact
        //price at the same time
        //By the project task: The first person who submited will succeed
        if ((string)$item->updated_at != (string)Carbon::now() && $item->price !=  $this->parameters['price']) {
            $item->Update( $this->parameters);
        }
        return $item;
    }
    
    public function CasualUpdate($id)
    {
        
        $item = Item::find($id);
        //Check if current user can update
        if ($item->user_id ==  $this->parameters['user_id']){
            $item->Update( $this->parameters);
        }

        return $item;
    }

    public function delete($ids)
    {
        //deletetion on recursion
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
        //Run heapsort and get first cheapest element and check if the item which user add is same
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
