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
class anItem{

    private $name = "";
    private $price = 0;
    private $userId = -1;

    public function __construct($request = null)
    {
        $this->name = $request['name'];
        $this->price = $request['price'];
        $this->userId = Auth::user()->id;
    }

   
    public function Create()
    {
        
        // $doesItemExists = Item::where([
        //     ['name','like','%'.$this->name]
        // ])->first();

        //dd(Carbon::now());
        $newItem = null;
        DB::beginTransaction();
        $doesItemExists = Item::lockForUpdate()->firstOrNew(
            ['name' => $this->name]
        );
        $newItem = ($doesItemExists->exists)
        ?anItem::Update($doesItemExists->id)
        :Item::create(['user_id'=> $this->userId, 'name'=> $this->name, 'price'=> $this->price]);
        DB::commit();

        // $newItem = ($doesItemExists === null) 
        // ? Item::create(['user_id'=> $this->userId, 'name'=> $this->name, 'price'=> $this->price]) 
        // : anItem::Update($doesItemExists->id);
        // $newItem->save();


       // ProcessItem::dispatch($newItem);
        event(new CatchChangesEvent());
        
        anItem::checkIfItemIsCheapest($newItem);

        
        

        return $newItem;
        // return null;
    }

    public function Update($id)
    {
        $item = Item::find($id);
        if((string)$item->updated_at != (string)Carbon::now() && $item->price != $this->price){
            $item->Update(['price'=> $this->price,'user_id'=> $this->userId]);
        }
        return $item;
    }
    public function Destroy($id)
    {
        $item = Item::find($id);
        $item->desroy();
        return $item;
    }

    public function checkIfItemIsCheapest($newItem)
    {
        
        $firstItem = (new HeapSort)->GetFirst();
        if( $firstItem[0]->id == $newItem->id){
            event(new CreatedNewCheapestItem($newItem));
        }
        

    }

}

class ItemFactory
{
  

    public static function create( $request)
    {
        return (new anItem($request))->Create();
    }
    public static function update(Request $request, $id)
    {
        return (new anItem($request))->Update($id);
    }
    public static function destroy($id)
    {
        return (new anItem())->Destroy($id);
    }

}