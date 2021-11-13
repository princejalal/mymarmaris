<?php

namespace App\Http\Controllers\adminpanel;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserController extends AdminController {

    public function __construct() {
        parent::__construct();
        $this->middleware('Roles');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $users = User::where('id','>',1)->get();


        return view('adminpanel.users.index',compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $user = User::where('id',$id)->first();

        return view('adminpanel.users.edit',compact('user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        try {

            User::where('id',$id)->update($request->except('_method','_token'));

            Session::flash('message', error_layout('User Information Update Successfuly'));

            return redirect('/adminpanel/manageUser');

        }catch (\Exception $e){

            Log::error($e);

            Session::flash('message', error_layout('Whoops!There were some problems,please try few minute later', 'div', 'alert alert-danger'));

            return redirect('/adminpanel/manageUser');

        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        User::where('id',$id)->delete();

        Session::flash('message', error_layout('User Delete Successfuly'));

        return response()->json([1]);

    }
}
