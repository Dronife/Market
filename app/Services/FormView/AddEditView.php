<?php
namespace App\Services\FormView;
use App\Models\Item;
use App\Services\AbstractViews\itemFormAbstract;

class AddEditView extends itemFormAbstract
{
    public function __construct($redirect, $view, $id = -1)
    {
        parent::__construct($redirect, $view, $id);  
    }

    public function getView()
    {
        return view($this->view,$this->parameters);
    }

}
