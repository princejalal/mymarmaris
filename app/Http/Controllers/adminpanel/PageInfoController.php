<?php

namespace App\Http\Controllers\adminpanel;

use App\Default_content;
use App\Http\Controllers\Controller;
use App\Language;
use App\Page_info;
use App\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PageInfoController extends AdminController {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($pageId, $langId) {

        $pageInfo = new \stdClass();

        $info = Page_info::where('page_id', $pageId)->where('lang_id', $langId)->first();

        $page = Pages::where('page_id', $pageId)->first();

        $defaultTemplate = Default_content::where('id', 1)->first();

        $language = Language::where('lang_id', $langId)->first();

        if ($info):

            $pageInfo = $info;

        endif;

        return view('adminpanel.pages.info', compact('pageInfo', 'page', 'language', 'pageId', 'defaultTemplate'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        // var_dump($request->all());die;
        $this->validator($request->all());

        try {

            Page_info::create($request->except('_token'));

            Session::flash('message', error_layout(' information for language Save successfuly!'));

            return redirect('/adminpanel/pages');

        } catch (\Exception $e) {
            Log::error($e);

            Session::flash('message', error_layout('Whoops!There were some problems,please try few minute later', 'div',
                'alert alert-danger'));

            return redirect('adminpanel/pages');
        }

    }


    protected function validator($data) {
        return Validator::make($data, [
            'page_name' => [
                'required',
                'max:300'
            ],
            'url'       => [
                'required',
                'max:500'
            ],
            'header'    => [
                'required',
                'max:2000'
            ],
            'content'   => [
                'required',
                'min:30'
            ],
            'title'     => ['max:170'],
            'meta_desc' => ['max:200'],
            'meta_tags' => ['max:350']
        ])->validate();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validator($request->all());

        try {
            Page_info::where('lang_id', $request->input('lang_id'))->where('page_id',
                $request->input('page_id'))->update($request->except('_method', '_token'));
            Session::flash('message', error_layout(' information for language Update successfuly!'));
            return redirect('adminpanel/pages');

        } catch (\Exception $e) {
            Log::error($e);
            Session::flash('message',
                error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));
            return redirect('adminpanel/pages');
        }


    }

    public function changeState($id) {

        $page = Pages::where('page_id', $id)->first();

        if ($page->publish == 1):

            Pages::where('page_id', $id)->update(['publish' => 0]);

        else:

            Pages::where('page_id', $id)->update(['publish' => 1]);

        endif;

        return back();


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $page = Page_info::find($id);

        $page->delete();

        Session::flash('message', error_layout('Page Information Remove Successfuly', 'div', 'danger-color'));

        return redirect('adminpanel/pages');
    }
}
