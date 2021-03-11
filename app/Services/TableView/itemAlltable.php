<?php
namespace App\Services\TableView;
use App\Services\AbstractViews\itemTableAbstract;
use App\Models\Item;


class itemAllTable extends itemTableAbstract{

    public function __construct($header , $view )
    {
        parent::__construct($header , $view);
    }
    public function getView(){
        $items = Item::get();
        return view($this->view,['header'=>$this->header , 'items' =>$items]);
    }
}
