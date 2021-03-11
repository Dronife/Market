<?php
namespace App\Services\FormView;
use App\Services\FormView\EditView;
class ViewForm {
    public function getItemForm($view, $redirect, $id)
    {
        return (new AddEditView($view, $redirect, $id))->getView();
    }

}