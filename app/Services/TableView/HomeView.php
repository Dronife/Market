<?php
namespace App\Services\TableView;
use App\Services\TableView\itemAllTable;
use App\Services\TableView\itemByIndexTable;
use App\Services\TableView\itemTop3;

class HomeView{
   
    public function getAllItemTable($view, $header )
    {
        return (new itemAllTable($header , $view))->getView();
    }

    public function itemByIndexTable($view, $header,$id)
    {
        return (new itemByIndexTable($header , $view, $id))->getView();
    }
    
    public function itemTop3($view, $header)
    {
        return (new itemTop3($header , $view))->getView();
    }

}

