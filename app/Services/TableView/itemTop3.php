<?php
namespace App\Services\TableView;
use App\Services\AbstractViews\itemTableAbstract;
use App\Services\HeapSort;
class itemTop3 extends itemTableAbstract{

    public function __construct($header , $view )
    {
        parent::__construct($header , $view);
    }

    public function getView(){
        
        $items = (new HeapSort)->sort();
        return view($this->view,['header'=>$this->header , 'items' =>($items->slice(0,3))]);
    }
}