<?php

namespace App\Http\Controllers\adminpanel;

use App\Blog;
use App\Destination_info;
use App\Destinations;
use App\District;
use App\Http\Controllers\Controller;
use App\Language;
use App\Mobile_content;
use App\Page_info;
use App\Photo;
use App\Tour;
use App\Tour_info;
use App\Tour_price;
use App\Tour_program;
use App\Tour_tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;

class DestinationController extends AdminController {

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
        $destinations = Destinations::orderBy('order', 'ASC')->get();

        return view('adminpanel.destination.index', compact('destinations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('adminpanel.destination.create');
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
        // uploading image with resize and change image name to destination name by dash(-)
        $image = $this->uploadImageWithResize($request, 'image', '/content/images/Destinations',
            '/content/images/Destinations/big', 800, 200, false, $data['destination_name']);

        try {
            Destinations::create([
                'destination_name' => $data['destination_name'],
                'order'            => $data['order'],
                'image'            => $image,
            ]);
            Session::flash('message', error_layout('destination '.$data['destination_name'].' save successfuly!'));
            return redirect('adminpanel/destination');
        } catch (Exception $e) {
            Log::error($e);
            Session::flash('message',
                error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));
            return redirect('adminpanel/destination');
        }
    }

    /**
     * @param  array  $data
     * @return mixed
     */
    protected function validator($data) {
        return Validator::make($data, [
            'destination_name' => [
                'required',
                'max:200',
                'unique:destinations'
            ]
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $destination = Destinations::where('destination_id', $id)->first();

        $destination_info = Destination_info::where('destination_id', $id)->select('destination_info.info_id',
            'destination_info.destination_name', 'language.lang_name', 'language.lang_id')->leftJoin('language',
            'language.lang_id', '=', 'destination_info.lang_id')->get();

        $langs = Language::where('publish', 1)->get();

        $languages = $this->checkLangExists($langs, $destination_info);

        return view('adminpanel.destination.show', compact('destination', 'destination_info', 'languages'));
    }

    /**
     * check destination has language information or not
     * @param $langs object
     * @param $dest_info object
     * @return array
     */
    private function checkLangExists($langs, $dest_info) {
        foreach ($langs as $key => $value):
            foreach ($dest_info as $info):
                if ($langs[$key]->lang_id == $info->lang_id):
                    $langs[$key]->haslang = 1;
                    break;
                endif;
                $langs[$key]->haslang = 0;
            endforeach;
        endforeach;

        return $langs;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $destination = Destinations::where('destination_id', $id)->first();

        return view('adminpanel.destination.edit', compact('destination'));
    }


    /**
     * @param  array  $data
     * @return mixed
     */
    protected function Editvalidator($data) {
        return Validator::make($data, [
            'destination_name' => [
                'required',
                'max:200'
            ]
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $data = $request->all();

        $this->Editvalidator($data)->validate();

        $dest = Destinations::where('destination_id', $id)->first();


        try {
            // by default in update proccess new image is last image save in data base
            $image = $dest->image;

            if ($request->hasFile('image')):
                if ($dest->image != null):
                    // in update procces if user select new image,delete last image from storage
                    if (file_exists(public_path('content/images/Destinations/'.$dest->image))):

                        unlink(public_path('content/images/Destinations/'.$dest->image));

                    endif;
                    // in update procces if user select new image,delete last image from storage
                    if (file_exists(public_path('content/images/Destinations/big/'.$dest->image))):

                        unlink(public_path('content/images/Destinations/big/'.$dest->image));

                    endif;

                endif;


                // upload image with resize and change name
                $image = $this->uploadImageWithResize($request, 'image', '/content/images/Destinations',
                    '/content/images/Destinations/big', 800, 200, false, $dest->destination_name);


            endif;
            // update destination information
            Destinations::where('destination_id', $id)->update([
                'destination_name' => $data['destination_name'],
                'order'            => $data['order'],
                'image'            => $image,
            ]);

            Session::flash('message', error_layout('Destination '.$data['destination_name'].' update successfuly!'));

            return redirect('adminpanel/destination');

        } catch (Exception $e) {

            Log::error($e);

            Session::flash('message',
                error_layout('Whoops!There were some problems,please try few minute later', 'div', 'alert-danger'));

            return back('adminpanel/destination');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $dest = Destinations::find($id);

        $tourCount = Tour::where('destination_id', $id)->get();

        foreach ($tourCount as $tour):

            Tour_info::where('tour_id', $tour->tour_id)->delete();

            Tour_program::where('tour_id', $tour->tour_id)->delete();

            Tour_price::where('tour_id', $tour->tour_id)->delete();

            $photos = Photo::where('tour_id', $tour->tour_id)->get();

            foreach ($photos as $photo):

                if (file_exists(public_path('content/images/Tours/'.$tour->tour_id.'/'.$photo->photo_path))):

                    unlink(public_path('content/images/Tours/'.$tour->tour_id.'/'.$photo->photo_path));

                endif;

                if (file_exists(public_path('content/images/Tours/'.$tour->tour_id.'/big/'.$photo->photo_path))):

                    unlink(public_path('content/images/Tours/'.$tour->tour_id.'/big/'.$photo->photo_path));

                endif;

                if (file_exists(public_path('content/images/Tours/'.$tour->tour_id.'/large/'.$photo->photo_path))):

                    unlink(public_path('content/images/Tours/'.$tour->tour_id.'/large/'.$photo->photo_path));

                endif;

            endforeach;

            Photo::where('tour_id', $tour->tour_id)->delete();

        endforeach;


        if (file_exists(public_path('content/images/Destinations/'.$dest->image))):

            unlink(public_path('content/images/Destinations/'.$dest->image));

        endif;

        if (file_exists(public_path('content/images/Destinations/big/'.$dest->image))):

            unlink(public_path('content/images/Destinations/big/'.$dest->image));

        endif;


        Tour::where('destination_id', $id)->delete();

        Destination_info::where('destination_id', $id)->delete();

        $dest->delete();

        Session::flash('message', error_layout('Destinations And Destinations Information Delete Successfuly!'));

        return response()->json([1]);

    }

    /**
     * @param $id
     */
    public function deleteDestinationInfo($id) {

        Destination_info::where('info_id', $id)->delete();


        Session::flash('message', error_layout('Destinations Information Delete Successfuly!'));

        return response()->json([1]);

    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destState($id) {
        $destination = Destinations::where('destination_id', $id)->first();

        if ($destination->publish == 1):
            Destinations::where('destination_id', $id)->update(['publish' => 0]);
            Session::flash('message', error_layout('Destination now is deactive!!'));
        else:
            Destinations::where('destination_id', $id)->update(['publish' => 1]);
            Session::flash('message', error_layout('Destination now is active!'));
        endif;

        return back();
    }

    /**
     * @param $destId
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addDestinationInfo($destId, $id) {

        $destInfo = new \stdClass();
        $destinationInfo = Destination_info::where('destination_id', $destId)->where('lang_id', $id)->first();
        $language = Language::where('lang_id', $id)->first();

        if ($destinationInfo):
            $destInfo = $destinationInfo;
        endif;

        return view('adminpanel.destination.infoEdit', compact('destId', 'language', 'destInfo'));

    }

    /**
     * @param  Request  $request
     * @param $destId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateDestinationInfo(Request $request, $destId) {

        $this->DestValidations($request->all())->validate();
        try {
            Destination_info::where('destination_id', $destId)->where('lang_id',
                $request->input('lang_id'))->update($request->except('_method', '_token'));
            Session::flash('message', error_layout('destination info update successfuly!'));
            return redirect('/adminpanel/destination');
        } catch (Exception $e) {
            Log::error($e);
            Session::flash('message',
                error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));
            return redirect('/adminpanel/destination');
        }

    }

    public function createDestinationInfo(Request $request, $destId) {

        $destInfo = Destination_info::where('lang_id', $request->input('lang_id'))->where('destination_id',
            $request->input('destination_id'))->first();

        if ($destInfo):

            Session::flash('message',
                error_layout('Destination Information for this language already exists', 'div', 'alert alert-danger'));

            return back();

        endif;


        $this->DestValidations($request->all())->validate();


        try {

            Destination_info::create($request->except('_method', '_token'));

            Session::flash('message', error_layout('destination info save successfuly!'));

            return redirect('/adminpanel/destination');

        } catch (Exception $e) {

            Log::error($e);

            Session::flash('message',
                error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));

            return redirect('/adminpanel/destination');

        }

    }


    protected function DestValidations($data) {

        return Validator::make($data, [
            'meta_desc'        => ['max:300'],
            'title'            => ['max:300'],
            'destination_name' => ['max:200'],
            'scrolling_text'   => ['max:500'],
            'info_text'        => ['max:500']
        ]);

    }
}
