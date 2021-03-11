<?php

namespace app\helper;
use App\Models\Item;
use App\Models\Notification;
use App\helper\HeapSort;


abstract class ItemViewHelper{
    public $view;
    public function __construct($view)
    {
        $this->view = $view;
      

    }
    abstract protected function getView();
}


abstract class itemTable extends ItemViewHelper{
    public $header  = 'Items';
    public function __construct($header , $view )
    {
        $this->header =$header ;
        parent::__construct($view);
        
    }

}


class itemAllTable extends itemTable{

    public function __construct($header , $view )
    {
        parent::__construct($header , $view);
    }

    public function getView(){
        $items = Item::get();
        return view($this->view,['header'=>$this->header , 'items' =>$items]);
    }
}

class itemByIndexTable extends itemTable{

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


class itemTop3 extends itemTable{

    public function __construct($header , $view )
    {
        parent::__construct($header , $view);
    }

    public function getView(){
        
        $items = (new HeapSort)->sort();
        return view($this->view,['header'=>$this->header , 'items' =>($items->slice(0,3))]);
    }
}





class itemForm extends ItemViewHelper
{

    private $name = '';
    private $price = 0;
    private $id = 0;
    private $redirect = '';

    public function __construct($redirect, $view, $id = -1)
    {
        parent::__construct($view);

        if($id != -1)
        {
            $item = Item::find($id);
            $this->name = $item->name;
            $this->price = $item->price;
            $this->id = $id;
        }
        $this->redirect = $redirect;
    }

    public function getView()
    {
      
        return view($this->view,['redirect' => $this->redirect, 'name' => $this->name, 'price'=>$this->price, 'id' => $this->id]);
       

    }

}


class viewTemplateHelper{
    public function getItemForm($view, $redirect, $id)
    {
        return (new itemForm($view, $redirect, $id))->getView();
    }

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
