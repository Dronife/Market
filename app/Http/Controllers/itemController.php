<?php

namespace App\Http\Controllers;

use App\Services\Factory\ItemFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Jobs\ProcessItem;
use App\Services\TableView\HomeView;
use App\Services\FormView\ViewForm;

class itemController extends Controller
{

    public function index()
    {

        return (new HomeView)->getAllItemTable('/home', 'Global item list');
    }


    public function create()
    {
        return (new ViewForm)->getItemForm('/item/store/', 'itemform', -1);
    }


    public function store(Request $request)
    {
        ProcessItem::dispatch($request->all());
        return redirect()->to('/home');
    }


    public function show()
    {
        $id = Auth::user()->id;
        return (new HomeView)->itemByIndexTable('/home', 'Your item list', $id);
    }


    public function topThree()
    {
        return (new HomeView)->itemTop3('/home', 'Top 3');
    }


    public function edit($id)
    {
        return (new ViewForm)->getItemForm('/item/update/' . $id, 'itemform', $id);
    }


    public function markNotification()
    {
        auth()->user()->unreadNotifications->markAsRead();
    }

    public function update(Request $request, $id)
    {

        ItemFactory::update($request->all(), $id);
        return redirect()->to('/home');
    }

    public function delete(Request $request)
    {
        ItemFactory::destroy($request->checkToDelete);
        return redirect()->to('/home');
    }
}
