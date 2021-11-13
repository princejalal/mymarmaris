<?php

namespace App\Http\Controllers\adminpanel;

use App\Http\Controllers\Controller;
use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

class SliderController extends AdminController {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $sliders = Slider::all();

        return view('adminpanel.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $slider = new \stdClass();

        return view('adminpanel.slider.create', compact('slider'));


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        Validator::make($request->all(), ['slider_name' => ['required', 'unique:slider'], 'image' => ['image', 'required']])->validate();

        if ($request->hasFile('image')):

            if (!file_exists(public_path('content/images/slider'))):

                mkdir(public_path('content/images/slider'), 0755, true);

            endif;

            if (!file_exists(public_path('content/images/slider/orginal'))):

                mkdir(public_path('content/images/slider/orginal'), 0755, true);

            endif;


            $orginName = $request->file('image')->getClientOriginalName();

            $fileName = pathinfo($orginName, PATHINFO_FILENAME);

            $extention = $request->file('image')->getClientOriginalExtension();

            $newName = $request->input('slider_name') . '_' . time() . '.' . $extention;

            $img = Image::make($request->file('image')->getRealPath());

            // resize to large size
            $img->resize(1920, 480)->save(public_path('content/images/slider/') . $newName);

            $orginalImg = Image::make($request->file('image')->getRealPath());

            $orginalImg->save(public_path('content/images/slider/orginal/') . $newName);

            $image = $newName;

        endif;


        try {
            Slider::create(['slider_name' => $request->input('slider_name'), 'image' => $image]);

            Session::flash('message', error_layout('Slider Save Successfuly!'));

            return redirect('/adminpanel/slider');

        } catch (Exception $e) {

            Log::error($e);

            Session::flash('message', error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));

            return redirect('/adminpanel/slider');

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

        $slider = Slider::where('slider_id', $id)->first();


        return view('adminpanel.slider.create', compact('slider'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $slider = Slider::where('slider_id', $id)->first();

        Validator::make($request->all(), ['slider_name' => ['required']])->validate();

        $image = $slider->image;

        if ($request->hasFile('image')):

            if (!file_exists(public_path('content/images/slider'))):

                unlink(public_path('content/images/slider/' . $slider->image));

            endif;
            $orginName = $request->file('image')->getClientOriginalName();

            $fileName = pathinfo($orginName, PATHINFO_FILENAME);

            $extention = $request->file('image')->getClientOriginalExtension();

            $newName = $request->input('slider_name') . '_' . time() . '.' . $extention;

            $img = Image::make($request->file('image')->getRealPath());

            // resize to large size
            $img->resize(1900, 480, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path('content/images/slider/') . $newName);

            $image = $newName;

        endif;


        try {
            Slider::where('slider_id', $id)->update(['slider_name' => $request->input('slider_name'), 'image' => $image]);

            Session::flash('message', error_layout('Slider Update Successfuly!'));

            return redirect('/adminpanel/slider');

        } catch (Exception $e) {

            Log::error($e);

            Session::flash('message', error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));

            return redirect('/adminpanel/slider');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $sldier = Slider::where('slider_id', $id)->first();

        if (file_exists(public_path('content/images/slider/' . $sldier->image))):

            unlink(public_path('content/images/slider/' . $sldier->image));

        endif;

        $sldier->delete();

        return response()->json([1]);

    }
}
