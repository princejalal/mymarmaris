<?php

namespace App\Http\Controllers\adminpanel;

use App\Http\Controllers\Controller;
use App\Language;
use App\Tour;
use App\Tour_program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProgramController extends AdminController {
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
    public function create($tourId, $langId) {

        $language = Language::where('lang_id', $langId)->first();

        $tour = Tour::where('tour_id', $tourId)->first();

        $programInfo = Tour_program::where('lang_id', $langId)->where('tour_id', $tourId)->first();

        $parentProgram = Tour_program::where('tour_id', $tour->parent_id)->where('lang_id', $langId)->first();

        if ($programInfo):
            $program = $programInfo;
        elseif (!$programInfo && $parentProgram):
            $program = $parentProgram;
        else:
            $program = new \stdClass();
        endif;

        return view('adminpanel.tours.editProgram', compact('program', 'language', 'tourId'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            Tour_program::create($request->except('_method', '_token'));

            Session::flash('message', error_layout('tour program info update successfuly!'));
            return redirect('/adminpanel/tours');

        } catch (Exception $e) {

            Log::error($e);
            Session::flash('message', error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));
            return redirect('/adminpanel/tours');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($tourId) {

        $tour = Tour::where('tour_id', $tourId)->first();

        $tour_program = Tour_program::where('tour_id', $tourId)->get();

        if (count($tour_program) < 1):

            $tour_program = Tour_program::where('tour_id',$tour->parent_id)->get();

        endif;


        $langs = Language::where('publish', 1)->get();

        $languages = $this->checkLanguageInfo($langs, $tour_program);

        return view('adminpanel.tours.program', compact('languages', 'tour', 'tour_program'));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tourId) {
        try {
            Tour_program::where('tour_id', $tourId)->where('lang_id', $request->input('lang_id'))->update($request->except('_method', '_token'));

            Session::flash('message', error_layout('tour program info update successfuly!'));
            return redirect('/adminpanel/tours');

        } catch (Exception $e) {

            Log::error($e);
            Session::flash('message', error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));
            return redirect('/adminpanel/tours');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        Tour_program::where('program_id', $id)->delete();

        Session::flash('message', error_layout('Delete Tour Program Successfuly!'));

        return response()->json([1]);

    }
}
