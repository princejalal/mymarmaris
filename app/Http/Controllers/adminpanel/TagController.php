<?php

namespace App\Http\Controllers\adminpanel;

use App\Http\Controllers\Controller;
use App\Language;
use App\Tour_tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TagController extends AdminController {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $tags = Tour_tag::paginate(10);


        return view('adminpanel.tags.index', compact('tags'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $tag = new \stdClass();
        $lang_id = 1;

        return view('adminpanel.tags.create', compact('tag', 'lang_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        Validator::make($request->all(), ['tag_name' => ['required']])->validate();

        $tag = Tour_tag::where('lang_id',$request->input('lang_id'))->where('');


        try {
            Tour_tag::create($request->except('_method', '_token'));
            Session::flash('message', error_layout('Tag Save Successfuly!'));
            return redirect('/adminpanel/tags');

        } catch (Exception $e) {

            Log::error($e);
            Session::flash('message', error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));
            return redirect('/adminpanel/tags');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $parent = Tour_tag::where('tag_id', $id)->first();

        $tag = new \stdClass();
        $lang = [];

        $langs = Language::where('publish', 1)->where('lang_id', '!=', 1)->get();

        foreach ($langs as $language):
            $lang[$language->lang_id] = $language->lang_short_name;
        endforeach;


        return view('adminpanel.tags.create', compact('tag', 'lang', 'parent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $tag = Tour_tag::where('tag_id', $id)->first();

        if ($tag->parent > 0):

            $lang = [];

            $parent = Tour_tag::where('tag_id', $tag->parent)->first();;

            $langs = Language::where('publish', 1)->where('lang_id', '!=', 1)->get();

            foreach ($langs as $language):
                $lang[$language->lang_id] = $language->lang_short_name;
            endforeach;

            $lang_id = $tag->lang_id;

            return view('adminpanel.tags.edit', compact('tag', 'lang_id','lang','parent'));

        else:

            $lang_id = $tag->lang_id;
            return view('adminpanel.tags.edit', compact('tag', 'lang_id'));

        endif;



    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        Validator::make($request->all(), ['tag_name' => ['required']])->validate();

        try {
            Tour_tag::where('tag_id', $id)->update($request->except('_method', '_token'));
            Session::flash('message', error_layout('Tag Save Successfuly!'));
            return redirect('/adminpanel/tags');

        } catch (Exception $e) {

            Log::error($e);
            Session::flash('message', error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));
            return redirect('/adminpanel/tags');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        Tour_tag::where('tag_id',$id)->delete();

        Session::flash('message', error_layout('Tag Delete Successfuly!'));

        return response()->json([1]);

    }
}
