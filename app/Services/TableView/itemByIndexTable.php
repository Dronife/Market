<?php
namespace App\Services\TableView;
use App\Services\AbstractViews\itemTableAbstract;
use App\Models\Item;

class itemByIndexTable extends itemTableAbstract{

    public  $id = 1;
    public function __construct($header , $view, $id)
    {
        parent::__construct($header , $view);
        $this->id=$id;
       
    }
    public function getView(){
        $items = Item::where('user_id','=', $this->id)->get();
        return view($this->view,['header'=>$this->header , 'items' =>$items]);
    }
}