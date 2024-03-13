<?php

namespace App\Http\Controllers\adminpanel\Messenger;

use App\Http\Controllers\adminpanel\AdminController;
use App\Messenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MessengerController extends AdminController
{
    const ROUTE = 'messenger.index';
    const DELETED = ':attr Deleted Successfully';
    const UPDATED = ':attr Updated Successfully';
    const STORED = ':attr Saved Successfully';

    public function index()
    {
        $messengers = Messenger::paginate(20);
        return view('adminpanel.messenger.index',compact('messengers'));
    }

    public function create()
    {
        $messenger = new \stdClass();
        return view('adminpanel.messenger.form',compact('messenger'));
    }

    public function store(Request $request)
    {
        Messenger::create($request->except('_token'));
        Session::flash('message',str_replace(':attr',$request->value,self::STORED));
        return redirect()->route(self::ROUTE);

    }

    public function edit(Messenger $messenger)
    {
        return view('adminpanel.messenger.form',compact('messenger'));
    }


    public function update(Request $request, Messenger $messenger)
    {
        $messenger->update($request->except('_token','_method'));
        Session::flash('message',str_replace(':attr',$request->value,self::UPDATED));
        return redirect()->route(self::ROUTE);
    }


    public function destroy(Messenger $messenger)
    {
        $messenger->delete();
        Session::flash('message',str_replace(':attr',$messenger->value,self::DELETED));
        return response()->json([1]);
    }

}
