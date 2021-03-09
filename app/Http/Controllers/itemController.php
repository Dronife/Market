<?php

namespace App\Http\Controllers;
use App\Services\ItemFactory;
use App\Models\Item;
use App\helper\itemFormHelper;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class itemController extends Controller
{
   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::get();
        // dd($items);
        return view('home', ['items'=>$items,'header' => 'Global items']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //in some examples it is shown that I need to use interfaces.
        //But for this exact scenario I just used simple helper
        
        $newItem = ItemFactory::create($request);
        //dd($newItem);
        return redirect()->to('/home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
        $items = Item::where('user_id',Auth::user()->id)->get();
        return view('home',['items'=>$items, 'header' => 'Your submited items']);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        return (new ItemFormHelper)->getParamsToView('/item/update/'.$id, 'itemform',$id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        Item::find($id)->Update($request->all());
        return redirect()->to('/home');
    }

    public function delete($id){

        return view('confirmDelete',['item' => Item::find($id),  'userid'=> $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::find($id)->delete();
        return redirect()->to('/home');
    }
}
