<?php

namespace App\Http\Controllers;

use App\Events\CreatedNewCheapestItem;
use App\Events\ItemCreatedEvent;
use app\helper\itemTable;
use App\Services\ItemFactory;
use App\Models\Item;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Events\ItemInsertProcessed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\helper\ViewTemplateHelper;
use App\Notifications\ItemCreated;
use App\Jobs\ProcessItem;

class itemController extends Controller
{




    public function index()
    {

        return (new ViewTemplateHelper)->getAllItemTable('/home', 'Global item list');
    }


    public function create()
    {
        return (new ViewTemplateHelper)->getItemForm('/item/store/', 'itemform', -1);
    }


    public function store(Request $request)
    {


        ProcessItem::dispatch($request->all());

        return redirect()->to('/home');
    }


    public function show()
    {

        $id = Auth::user()->id;
        return (new ViewTemplateHelper)->itemByIndexTable('/home', 'Your item list', $id);
    }


    public function topThree()
    {

        return (new ViewTemplateHelper)->itemTop3('/home', 'Top 3');
    }


    public function edit($id)
    {

        return (new ViewTemplateHelper)->getItemForm('/item/update/' . $id, 'itemform', $id);
    }


    public function markNotification()
    {


        auth()->user()->unreadNotifications->markAsRead();
    }

    public function update(Request $request, $id)
    {

        ItemFactory::update($request->all(),$id);
        return redirect()->to('/home');
    }

    public function delete(Request $request)
    {
        ItemFactory::destroy($request->checkToDelete);
        return redirect()->to('/home');
    }
}
