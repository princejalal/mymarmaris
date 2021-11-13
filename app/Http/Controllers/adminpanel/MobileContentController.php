<?php

namespace App\Http\Controllers\adminpanel;

use App\Http\Controllers\Controller;
use App\Language;
use App\Mobile_content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class MobileContentController extends AdminController {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {


        $langs = Language::where('publish',1)->get();


        return view('adminpanel.mobile.index',compact('langs'));

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


        try {

            Mobile_content::create($request->except('_method', '_token'));

            Session::flash('message', error_layout('Content Save Successfuly!'));

            return back();

        } catch (Exception $e) {

            Log::error($e);

            Session::flash('message', error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));

            return back();
        }


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
        //
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

           Mobile_content::where('id',$id)->update($request->except('_method', '_token'));

            Session::flash('message', error_layout('Content Update Successfuly!'));

            return back();

        } catch (Exception $e) {

            Log::error($e);

            Session::flash('message', error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
