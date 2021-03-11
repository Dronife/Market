<?php
namespace App\Services\AbstractViews;
use App\Models\Item;

abstract class itemFormAbstract extends ViewAbstract{
    public $parameters = [
        'name' => '',
        'price' => 0,
        'id' => 0,
        'redirect' => 'redirect'
    ];
    public function __construct($redirect, $view, $id = -1)
    {
        parent::__construct($view);

        if($id != -1)
        {
            $item = Item::find($id);
            $this->parameters = ['name' => $item->name, 'price' => $item->price, 'id'=> $id];
        }
        $this->parameters['redirect'] = $redirect;
    }

}