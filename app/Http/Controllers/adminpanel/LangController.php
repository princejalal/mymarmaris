<?php

namespace App\Http\Controllers\adminpanel;

use App\Blog;
use App\Currency;
use App\Destination_info;
use App\Http\Controllers\Controller;
use App\Language;
use App\Mobile_content;
use App\Page_info;
use App\Tour_info;
use App\Tour_program;
use App\Tour_tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LangController extends AdminController {
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
        $languages = Language::all();
        return view('adminpanel.language.index', compact('languages'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $currency = Currency::all();

        $currences = [];

        foreach ($currency as $curr):

            $currences[$curr->currency_id] = $curr->currency_name;

        endforeach;

        return view('adminpanel.language.create', compact('currences'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $data = $request->all();

        $this->validator($data)->validate();

        $flag = $this->uploadImage($request, 'flag', '/content/images/');


        try {

            Language::create(['lang_name'       => $data['lang_name'],
                              'lang_eng_name'   => $data['lang_eng_name'],
                              'lang_short_name' => $data['lang_short_name'],
                              'currency_id'     => $data['currency_id'],
                              'flag'            => $flag
            ]);

            Session::flash('message', error_layout('language '.$data['lang_name'].' save successfuly!'));
            return back();
        } catch (Exception $e) {
            Log::error($e);
            Session::flash('message',
                error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));
            return back();
        }

    }

    /**
     * @param  array  $data
     * @return mixed
     */
    protected function validator($data) {
        return Validator::make($data, [
            'lang_name'       => [
                'required',
                'max:200',
                'unique:language'
            ],
            'lang_eng_name'   => ['required'],
            'lang_short_name' => ['required'],
            'flag'            => ['required']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $currency = Currency::all();

        $currences = [];

        foreach ($currency as $curr):

            $currences[$curr->currency_id] = $curr->currency_name;

        endforeach;

        $lang = Language::where('lang_id', $id)->first();

        return view('adminpanel.language.edit', compact('lang', 'currences'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $lang = Language::where('lang_id', $id)->first();

        $data = $request->all();

        $flag = $lang->flag;

        if ($request->hasFile('flag')):
            if (file_exists(public_path('/content/images/'.$lang->flag))):

                unlink(public_path('/content/images/'.$lang->flag));

            endif;

            $flag = $this->uploadImage($request, 'flag', '/content/images/');

        endif;

        try {

            Language::where('lang_id', $id)->update(['lang_name'       => $data['lang_name'],
                                                     'lang_eng_name'   => $data['lang_eng_name'],
                                                     'lang_short_name' => $data['lang_short_name'],
                                                     'currency_id'     => $data['currency_id'],
                                                     'flag'            => $flag
            ]);

            Session::flash('message', error_layout('language '.$data['lang_name'].' update successfuly!'));
            return back();
        } catch (Exception $e) {
            Log::error($e);
            Session::flash('message',
                error_layout('Whoops!There were some problems,please try few minute later', 'div', 'alert-danger'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $lang = Language::where('lang_id', $id)->first();

        Tour_info::where('lang_id', $id)->delete();

        Tour_program::where('lang_id', $id)->delete();

        Destination_info::where('lang_id', $id)->delete();

        // District_info::where('lang_id',$id)->delete();

        Blog::where('lang_id', $id)->delete();

        Mobile_content::where('lang_id', $id)->delete();

        Tour_tag::where('lang_id', $id)->delete();

        Page_info::where('lang_id', $id)->delete();

        if (file_exists(public_path($lang->flag))):

            unlink(public_path($lang->flag));

        endif;

        $lang->delete();

        Session::flash('message', error_layout('Language Delete Success'));

        return response()->json([1]);

    }


    public function langState($id) {
        $language = Language::where('lang_id', $id)->first();


        if ($language->publish == 1):
            Language::where('lang_id', $id)->update(['publish' => 0]);
            Session::flash('message', error_layout('Language now is deactive!!'));
        else:
            Language::where('lang_id', $id)->update(['publish' => 1]);
            Session::flash('message', error_layout('Language now is active!'));
        endif;

        return back();
    }
}
