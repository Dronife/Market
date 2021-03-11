<?php
namespace App\Services\AbstractViews;

abstract class itemTableAbstract extends ViewAbstract{
    public $header  = 'Items';
    public function __construct($header , $view )
    {
        $this->header =$header ;
        parent::__construct($view);
        
    }

}