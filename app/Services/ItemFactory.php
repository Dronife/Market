<?php
namespace App\Services;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Events\CreatedNewCheapestItem;
use App\helper\HeapSort;

class anItem{

    private $name = "";
    private $price = 0;
    private $userId = -1;

    public function __construct(Request $request)
    {
        $this->name = $request->name;
        $this->price = $request->price;
        $this->userId = Auth::user()->id;
    }

   
    public function Create()
    {
        
        $doesItemExists = Item::where([
            ['name','like','%'.$this->name]
        ])->first();

        $newItem = ($doesItemExists === null) 
        ? Item::create(['user_id'=> $this->userId, 'name'=> $this->name, 'price'=> $this->price]) 
        : anItem::Update($doesItemExists->id);
        
        anItem::checkIfItemIsCheapest($newItem);

        return $newItem;
    }

    public function Update($id){
        $item = Item::find($id);
        $item->Update(['price'=> $this->price,'user_id'=> $this->userId]);
        return $item;
    }

    public function checkIfItemIsCheapest($newItem){
        
        $firstItem = (new HeapSort)->GetFirst();
        if( $firstItem[0]->id == $newItem->id){
            event(new CreatedNewCheapestItem($newItem));
        }

    }

}

class ItemFactory
{
    public static function create(Request $request)
    {
        return (new anItem($request))->Create();
    }
}