<?php

namespace App\Http\Controllers\adminpanel;

use App\Http\Controllers\Controller;
use App\Page_info;
use App\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PageController extends AdminController {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $pages = Pages::all();

        return view('adminpanel.pages.index', compact('pages'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('adminpanel.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {


        $page = Pages::where('kind',$request->input('kind'))->where('kind','!=','general')->first();
        // var_dump($page);die;

        if($page):

            Session::flash('message', error_layout('This Kind of Page Exists','div','alert alert-danger'));
            return redirect()->back()->withInput();

        endif;

        Validator::make($request->all(), [
            'page_name' => [
                'required',
                'max:200'
            ]
        ])->validate();

        try {

            Pages::create($request->except('_method', '_token'));
            Session::flash('message',
                error_layout('Page Save successfuly!You can edit or add page information with deffrent language <a class="text-danger" href="/adminpanel/pages">here</a>'));
            return redirect('/adminpanel/pages');

        } catch (\Exception $e) {
            Log::error($e);
            Session::flash('message',
                error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));
            return redirect('adminanel/pages');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $page = Pages::where('page_id', $id)->first();

        $pageInfo = Page_info::where('page_id', $id)->get();

        $langs = $this->checkLanguageInfo($this->languages, $pageInfo);

        return view('adminpanel.pages.show', compact('langs', 'id', 'page'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $page = Pages::where('page_id', $id)->first();

        return view('adminpanel.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        Validator::make($request->all(), [
            'page_name' => [
                'required',
                'max:200'
            ]
        ])->validate();


        $page = Pages::where('page_id',$id)->first();


        if($page->kind != $request->input('kind') && $page->kind != 'general'):

            Session::flash('message', error_layout('This Kind of Page Exists','div','alert alert-danger'));
            return redirect()->back()->withInput();

        endif;


        try {

            Pages::where('page_id', $id)->update($request->except('_method', '_token'));
            Session::flash('message', error_layout('Page edit successfuly!'));
            return redirect('/adminpanel/pages');

        } catch (\Exception $e) {
            Log::error($e);
            Session::flash('message',
                error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));
            return redirect('adminanel/pages');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $page_info = Page_info::where('page_id', $id)->first();
        if ($page_info):

            $page_info->delete();

        endif;

        Pages::where('page_id', $id)->delete();

        Session::flash('message', error_layout('The Page And information about page Delete Successfuly'));

        return response()->json([1]);

    }
}
