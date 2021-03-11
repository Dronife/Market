<?php
namespace App\Services\AbstractViews;

abstract class ViewAbstract{
    public $view;
    public function __construct($view)
    {
        $this->view = $view;
    }
    abstract protected function getView();
}

