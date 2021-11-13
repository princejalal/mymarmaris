<?php

namespace App\Http\Controllers\adminpanel;

use App\Destinations;
use App\District;
use App\District_info;
use App\Http\Controllers\Controller;
use App\Language;
use App\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class DistrictsController extends AdminController {

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

        $districts = District::orderBy('order', 'ASC')->select('districts.*', 'destinations.destination_name')->leftJoin('destinations', 'destinations.destination_id', '=', 'districts.destination_id')->paginate(10);

        return view('adminpanel.districts.index', compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $dest = [];
        $destinations = Destinations::where('publish', 1)->get();


        foreach ($destinations as $destination):

            $dest[$destination->destination_id] = $destination->destination_name;

        endforeach;

        return view('adminpanel.districts.create', compact('dest'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request) {

        $data = $request->all();

        $this->validator($data)->validate();

        try {

            $image = $this->uploadImageWithResize($request, 'image', '/content/images/District', '/content/images/District/big', 800, 200, false, $data['district_name']);

            District::create(['district_name' => $data['district_name'], 'destination_id' => $data['destination_id'], 'order' => $data['order'], 'image' => $image]);

            Session::flash('message', error_layout('district ' . $data['district_name'] . ' save successfuly!'));

            return redirect('adminpanel/districts');

        } catch (Exception $e) {
            Log::error($e);

            Session::flash('message', error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));

            return redirect('adminpanel/districts');
        }

    }


    protected function validator($data) {
        return Validator::make($data, ['district_name' => ['required', 'max:200', 'unique:districts'], 'image' => ['required', 'image']]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id) {

        $district = District::where('district_id', $id)->first();

        $distirict_info = District_info::where('district_id', $id)->get();

        $langs = Language::where('publish', 1)->get();

        $languages = $this->checkLanguageInfo($langs, $distirict_info);

        return view('adminpanel.districts.show', compact('languages', 'distirict_info', 'district'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) {
        $dest = [];

        $destinations = Destinations::where('publish', 1)->get();


        foreach ($destinations as $destination):

            $dest[$destination->destination_id] = $destination->destination_name;

        endforeach;
        $district = District::where('district_id', $id)->first();

        return view('adminpanel.districts.edit', compact('dest', 'district'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id) {

        $data = $request->all();

        $dist = District::where('district_id', $id)->first();


        try {

            $image = $dist->image;

            if ($request->hasFile('image')):
                $image = $this->uploadImageWithResize($request, 'image', '/content/images/District', '/content/images/District/big', 800, 200, false, $data['district_name']);
            endif;

            District::where('district_id', $id)->update(['district_name' => $data['district_name'], 'destination_id' => $data['destination_id'], 'order' => $data['order'], 'image' => $image]);

            Session::flash('message', error_layout('district ' . $data['district_name'] . ' update successfuly!'));

            return redirect('adminpanel/districts');

        } catch (Exception $e) {

            Log::error($e);

            Session::flash('message', error_layout('Whoops!There were some problems,please try few minute later', 'div', 'alert-danger'));

            return back('adminpanel/districts');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $dist = District::find($id);

        $tourCount = Tour::where('district_id', $id)->count();

        if ($tourCount > 0):

            Session::flash('message', error_layout('This District Has ' . $tourCount . ' Tours. if you want to delete this please change tour district or first delete all tours','div','alert alert-danger'));

            return response()->json([0]);

        endif;


        if (file_exists(public_path('content/images/District/' . $dist->image))):

            unlink(public_path('content/images/District/' . $dist->image));

        endif;

        if (file_exists(public_path('content/images/District/big/' . $dist->image))):

            unlink(public_path('content/images/District/big/' . $dist->image));

        endif;

        District_info::where('district_id', $id)->delete();

        $dist->delete();

        Session::flash('message', error_layout('District And District Information Delete successfuly!'));

        return response()->json([1]);

    }

    /**
     * active or de active districts
     * @param integer $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function districtState($id) {


        $district = District::where('district_id', $id)->first();

        if ($district->publish == 1):

            District::where('district_id', $id)->update(['publish' => 0]);

            Session::flash('message', error_layout('District now is Deactive'));

            return back();
        else:
            District::where('district_id', $id)->update(['publish' => 1]);

            Session::flash('message', error_layout('District now is Active'));

            return back();

        endif;

    }


    /**
     * @param $distId
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addDistrictInfo($distId, $id) {

        $distInfo = new \stdClass();


        $districtInfo = District_info::where('district_id', $distId)->where('lang_id', $id)->first();

        $language = Language::where('lang_id', $id)->first();


        if ($districtInfo):

            $distInfo = $districtInfo;

        endif;

        return view('adminpanel.districts.infoEdit', compact('distId', 'language', 'distInfo'));
    }

    /**
     * @param Request $request
     * @param $distId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateDistrictInfo(Request $request, $distId) {

        $this->DistValidations($request->all())->validate();

        try {

            District_info::where('district_id', $distId)->where('lang_id', $request->input('lang_id'))->update($request->except('_method', '_token'));

            Session::flash('message', error_layout('districts info update successfuly!'));

            return redirect('/adminpanel/districts/' . $distId);

        } catch (Exception $e) {

            Log::error($e);

            Session::flash('message', error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));

            return redirect('/adminpanel/districts/' . $distId);
        }

    }

    /**
     * @param Request $request
     * @param integer $distId
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createDistrictInfo(Request $request, $distId) {

        $distInfo = District_info::where('lang_id',$request->input('lang_id'))
            ->where('district_id',$request->input('district_id'))->first();

        if($distInfo):

            Session::flash('message', error_layout('District Information for this language already exists','div','alert alert-danger'));

            return back();

        endif;



        $this->DistValidations($request->all())->validate();

        try {

            District_info::create($request->except('_method', '_token'));

            Session::flash('message', error_layout('districts info save successfuly!'));

            return redirect('/adminpanel/districts/' . $request->input('district_id'));

        } catch (Exception $e) {
            // log error into log file
            Log::error($e);

            Session::flash('message', error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));

            return redirect('/adminpanel/districts');
        }

    }

    /**
     * @param $id
     */
    public function deleteDistrictInfo($id) {

        District_info::where('district_info_id', $id)->delete();

        Session::flash('message', error_layout('Districts Info Delete Successfuly!'));

        return response()->json([1]);

    }

    protected function DistValidations($data) {

        return Validator::make($data, ['meta_desc' => ['max:160'], 'title' => ['max:160'], 'district_name' => ['max:200'], 'scrolling_text' => ['max:500']]);

    }

}
