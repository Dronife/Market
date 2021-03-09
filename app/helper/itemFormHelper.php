<?php

namespace app\helper;
use App\Models\Item;

class itemForm
{

    private $name = '';
    private $price = 0;
    private $id = 0;
    private $redirect = '';
    private $view = '';

    public function __construct($redirect, $view, $id = -1)
    {
        if($id != -1)
        {
            $item = Item::find($id);
            $this->name = $item->name;
            $this->price = $item->price;
            $this->id = $id;
        }
        
        $this->redirect = $redirect;
        $this->view = $view;
    }

    public function returnView()
    {
      
        return view($this->view,['redirect' => $this->redirect, 'name' => $this->name, 'price'=>$this->price, 'id' => $this->id]);

    }

}

class ItemFormHelper{
    public function getParamsToView($redirect, $view, $id ){
        return (new itemForm($redirect, $view, $id))->returnView();
    }
}