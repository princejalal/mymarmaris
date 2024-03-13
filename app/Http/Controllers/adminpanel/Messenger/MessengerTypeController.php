<?php

namespace App\Http\Controllers\adminpanel\Messenger;

use App\Http\Controllers\adminpanel\AdminController;
use App\Messenger_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MessengerTypeController extends AdminController
{
    const STORED = ':attr Saved Successfully';
    const UPDATED = ':attr Updated Successfully';
    const DELETED = ':attr Deleted Successfully';

    public function index()
    {
        $types = Messenger_type::get();
        return view('adminpanel.messenger.type.index',compact('types'));
    }

    public function store(Request $request)
    {
        Messenger_type::create($request->except('_token'));
        Session::flash('message',str_replace(':attr',$request->name,self::STORED));
        return back();
    }

    public function update(Request $request, Messenger_type $messenger_type)
    {
        $messenger_type->update($request->except('_token','_method'));
        Session::flash('message',str_replace(':attr',$request->name,self::UPDATED));
        return back();
    }

    public function destroy(Messenger_type $messenger_type)
    {
        $messenger_type->delete();
        Session::flash('message',str_replace(':attr',$messenger_type->name,self::DELETED));
        return response()->json([1]);
    }
}
