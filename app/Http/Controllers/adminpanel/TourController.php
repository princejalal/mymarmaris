<?php

namespace App\Http\Controllers\adminpanel;

use App\Destinations;
use App\District;
use App\Http\Controllers\Controller;
use App\Language;
use App\Photo;
use App\Reserve;
use App\Tour;
use App\Tour_info;
use App\Tour_price;
use App\Tour_program;
use App\Tour_tag;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManagerStatic as Image;

/**
 * Class TourController
 * @package App\Http\Controllers\adminpanel
 */
class TourController extends AdminController {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($destId = null) {

        $tours = Tour::select('tour.*')->where('parent_id', 0)->paginate(15);

        return view('adminpanel.tours.index', compact('tours'));

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDistricts($id) {

        $tour = Tour::where('tour_id', $id)->first();

        $tours = Tour::where('parent_id', $id)->get();

        $districts = District::where('destination_id', $tour->destination_id)->get();

        $dists = $this->checkHasDistrict($districts, $tours);

        return view('adminpanel.tours.district', compact('dists', 'tour', 'tours'));

    }

    /**
     * create Tour with district from parent tour
     * @param $distId
     * @param $parentId
     */
    public function createWithDistricts($distId, $parentId) {

        $dest = [];

        $tour = Tour::where('tour_id', $parentId)->first();

        $destination = Destinations::where('destination_id', $tour->destination_id)->first();

        $dist = District::where('district_id', $distId)->first();

        $dest[$destination->destination_id] = $destination->destination_name;

        $tag = Tour_tag::where('lang_id', get_lang_id(App::getLocale()))->get();

        $tags = [];

        foreach ($tag as $s):

            $tags[$s->tag_id] = $s->tag_name;

        endforeach;

        return view('adminpanel.tours.create', compact('distId', 'tour', 'dest', 'dist', 'tags'));
    }


    function deleteWithDistricts($id) {

        Tour::where('tour_id', $id)->delete();

        Session::flash('message', error_layout('Tour for Districts Delete Successfully'));

        return response()->json([1]);


    }

    /**
     * @param $districts
     * @param $tours
     * @return mixed
     */
    protected function checkHasDistrict($districts, $tours) {

        foreach ($districts as $key => $value):

            foreach ($tours as $tour):

                if ($districts[$key]->district_id == $tour->district_id):

                    $districts[$key]->hasDist = 1;
                    $districts[$key]->tour_id = $tour->tour_id;
                    break;

                endif;

                $districts[$key]->hasDist = 0;
                $districts[$key]->tour_id = $tour->tour_id;

            endforeach;

        endforeach;

        return $districts;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $dest = [];
        $destinations = Destinations::where('publish', 1)->get();
        $tour = new \stdClass();

        foreach ($destinations as $destination):
            $dest[$destination->destination_id] = $destination->destination_name;
        endforeach;

        $tag = Tour_tag::where('lang_id', get_lang_id(App::getLocale()))->get();

        $tags = [];

        foreach ($tag as $s):

            $tags[$s->tag_id] = $s->tag_name;

        endforeach;

        return view('adminpanel.tours.create', compact('dest', 'tour', 'tags'));

    }


    /**
     * this method for change title and explain tours in destination
     * instead create new tour_info it's save new tour with parent_id then name and explain show on tour card in destination
     *
     * @param $tourId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changeName($tourId, $lngId) {

        $tour = Tour::where('tour_id', $tourId)->first();

        $destinations = Destinations::where('publish', 1)->get();

        return view('adminpanel.tours.changeName', compact('tour', 'destinations', 'lngId'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $this->tourValidator($request->all())->validate();

        try {
            Tour::create($request->except('_method', '_token'));

            Session::flash('message', error_layout('Tour '.$request->input('district_name').' save successfuly!'));

            return redirect('adminpanel/tours');

        } catch (Exception $e) {

            Log::error($e);

            Session::flash('message',
                error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));

            return redirect('adminpanel/tours');

        }

    }

    /**
     * @param $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function tourValidator($data) {
        return Validator::make($data, [
            'tour_name' => [
                'required',
                'max:200',
                'unique:tour'
            ]
        ]);
    }

    /**
     * @param $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function editTourValidator($data) {
        return Validator::make($data, [
            'tour_name' => [
                'required',
                'max:200'
            ]
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id) {
        // select tour from tours table where tour_id  = $id
        $tour = Tour::where('tour_id', $id)->first();

        $tourInfo = Tour_info::where('tour_id', $id)->get();

        if (count($tourInfo) < 1):

            $tourInfo = Tour_info::where('tour_id', $tour->parent_id)->get();

        endif;

        $langs = Language::where('publish', 1)->get();

        $languages = $this->checkLanguageInfo($langs, $tourInfo);

        return view('adminpanel.tours.show', compact('languages', 'tour', 'tourInfo'));

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $dest = [];

        $destinations = Destinations::where('publish', 1)->get();

        $tour = Tour::find($id);

        foreach ($destinations as $destination):

            $dest[$destination->destination_id] = $destination->destination_name;

        endforeach;

        $tag = Tour_tag::where('lang_id', get_lang_id(App::getLocale()))->get();

        $tags = [];

        foreach ($tag as $s):

            $tags[$s->tag_id] = $s->tag_name;

        endforeach;


        return view('adminpanel.tours.edit', compact('dest', 'tour', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $this->editTourValidator($request->all())->validate();

        try {
            Tour::where('tour_id', $id)->update($request->except('_method', '_token'));

            Session::flash('message', error_layout('Tour Edit successfuly!'));

            return redirect('adminpanel/tours');

        } catch (Exception $e) {

            Log::error($e);

            Session::flash('message',
                error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));

            return redirect('adminpanel/tours');

        }


    }

    /**
     * Remove the specified resource from storage.
     * remove tour and all information about tour
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $tour = Tour::where('tour_id', $id)->first();

        $subTourCount = Tour::where('parent_id', $id)->count();


        if ($subTourCount > 0):

            Session::flash('message',
                error_layout('This Tours Has '.$subTourCount.' Sub Tours. if you want to delete this first delete all sub tours',
                    'div', 'alert alert-danger'));

            return response()->json([0]);

        endif;


        Tour_price::where('tour_id', $id)->delete();

        Tour_info::where('tour_id', $id)->delete();

        Tour_program::where('tour_id', $id)->delete();

        Photo::where('tour_id', $id)->delete();

        Reserve::where('tour_id', $id)->delete();

        $tour->delete();

        Session::flash('message', error_layout('Tours Deleted successfuly'));

        return response()->json([1]);

    }

    /**
     * Active or Deactive tours
     *
     * @param $id
     */
    public function changeState($id) {

        $tour = Tour::where('tour_id', $id)->first();

        if ($tour->publish == 1):

            Tour::where('tour_id', $id)->update(['publish' => 0]);

            Session::flash('message', error_layout('Tour now is Deactive'));

            return back();

        else:

            Tour::where('tour_id', $id)->update(['publish' => 1]);

            Session::flash('message', error_layout('Tour now is Active'));

            return back();

        endif;


    }

    /**
     * Delete tour Info
     * @param  integer  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function InfoDestroy($id) {

        $tour = Tour::find($id);

        $tour->delete();


        Session::flash('message', error_layout('Tour Info Deleted successfuly'));

        return response()->json([1]);

    }

    /**
     * @param $tourId
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addTourInfo($tourId, $id) {


        $tour_info = Tour_info::where('tour_id', $tourId)->where('lang_id', $id)->first();

        $tour = Tour::where('tour_id', $tourId)->first();

        $parentTourInfo = Tour_info::where('tour_id', $tour->parent_id)->where('lang_id', $id)->first();

        $language = Language::where('lang_id', $id)->first();

        if ($tour_info):
            $tourInfo = $tour_info;
        elseif (!$tour_info && $parentTourInfo):
            $tourInfo = $parentTourInfo;
        else:
            $tourInfo = new \stdClass();
        endif;

        return view('adminpanel.tours.infoEdit', compact('tourInfo', 'tourId', 'language'));

    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createTourInfo(Request $request) {


        $tour = Tour::where('tour_id', $request->input('tour_id'))->first();

        if ($tour->parent_id == 0):

            // if ($request->input('lang_id') == 1 && check_link_in_text($request->input('content')) == false):
            //
            //     return back()->withErrors(['error' => __('message.InsertLinkInContent')])->withInput();
            //
            // endif;

            $this->tourValidatation($request->all())->validate();

        else:

            $this->tourDistrictValidatation($request->all())->validate();

        endif;


        try {

            Tour_info::create($request->except('_method', '_token'));

            Session::flash('message', error_layout('Tour info save successfuly!'));
            return redirect('/adminpanel/tours');

        } catch (Exception $e) {

            Log::error($e);

            Session::flash('message',
                error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));

            return redirect('/adminpanel/tours');
        }
    }

    /**
     * @param  Request  $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateTourInfo(Request $request, $id) {

        $tour = Tour::where('tour_id', $id)->first();

        if ($tour->parent_id == 0):
            // if (check_link_in_text($request->input('content')) == false):
            //
            //     return back()->withErrors(['error' => __('message.InsertLinkInContent')])->withInput();
            //
            // endif;
            $this->tourValidatation($request->all())->validate();
        else:

            $this->tourDistrictValidatation($request->all())->validate();

        endif;

        try {
            Tour_info::where('tour_id', $id)->where('lang_id',
                $request->input('lang_id'))->update($request->except('_method', '_token'));
            Session::flash('message', error_layout('Tour info update successfuly!'));
            return redirect('/adminpanel/tours');
        } catch (Exception $e) {
            Log::error($e);
            Session::flash('message',
                error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));
            return redirect('/adminpanel/tours');
        }
    }

    /**
     * @param $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function tourValidatation($data) {

        return Validator::make($data, [
            'tour_name' => [
                'required',
                'max:200'
            ],
            'content'   => ['min:1000'],
            'meta_desc' => ['max:200'],
            'title'     => ['max:200']
        ]);

    }

    /**
     * @param $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function tourDistrictValidatation($data) {

        return Validator::make($data, [
            'tour_name' => [
                'required',
                'max:200'
            ],
            'meta_desc' => ['max:200'],
            'title'     => ['max:200']
        ]);

    }


    /**
     * @param  integer  $id
     */
    public function showTourPhoto($id) {

        $photos = Photo::where('tour_id', $id)->get();

        return view('adminpanel.tours.photo', compact('photos', 'id'));

    }

    /**
     * Upload Photo for Tours
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function uploadTourPhoto(Request $request) {

        $tour_id = $request->input('tour_id');

        $tour = Tour::where('tour_id', $tour_id)->first();

        $tourName = str_replace(' ', '-', $tour->tour_name);


        if ($request->hasFile('tourPhoto')):

            $files = $request->file('tourPhoto');


            $messages = '';

            foreach ($files as $file):

                $orginName = $file->getClientOriginalName();

                $fileName = pathinfo($orginName, PATHINFO_FILENAME);

                $extention = $file->getClientOriginalExtension();

                $newName = $tourName.'_'.time().uniqid().'.'.$extention;


                if (!file_exists(public_path('/content/images/Tours/'.$tour_id.'/big'))):
                    mkdir(public_path('/content/images/Tours/'.$tour_id.'/big'), 0755, true);
                endif;


                if ($extention == 'gif'):

                    $file->move(public_path('content/images/Tours/'.$tour_id.'/'), $newName);

                else:

                    $img = Image::make($file->getRealPath())->resize(400, 225);

                    $watermarkSmall = Image::make(public_path('content/images/watermarker.png'))->resize(100,
                        20)->opacity(50);

                    $img->insert($watermarkSmall, 'top-left', 10, 10);

                    $img->save(public_path('/content/images/Tours/'.$tour_id).'/'.$newName);

                    $imgRealSize = Image::make($file->getRealPath())->resize(800, 450);

                    $watermark = Image::make(public_path('content/images/watermarker.png'))->resize(130,
                        32)->opacity(50);

                    $imgRealSize->insert($watermark, 'top-left', 10, 10);

                    $imgRealSize->save(public_path('/content/images/Tours/'.$tour_id.'/big/').$newName);

                endif;


                if (file_exists(public_path('/content/images/Tours/'.$tour_id.'/'.$newName))):

                    $messages .= '<li> '.$orginName.' upload successfuly</li>';
                    try {
                        Photo::create(['tour_id'    => $tour_id,
                                       'photo_path' => $newName
                        ]);
                    } catch (\Exception $e) {
                        Log::error($e);
                    }

                else:

                    $messages .= '<li> '.$orginName.' upload fail</li>';

                endif;

            endforeach;

            Session::flash('message', error_layout($messages, 'ul', 'alert-success'));

            return redirect('/adminpanel/tours/'.$tour_id.'/photo');

        endif;

    }

    /**
     * delete all tour photos
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteAllPhoto($id) {

        $photos = Photo::where('tour_id', $id)->get();


        foreach ($photos as $photo):

            if (file_exists(public_path('content/images/Tours/'.$id.'/'.$photo->photo_path))):
                unlink(public_path('content/images/Tours/'.$photo->tour_id.'/'.$photo->photo_path));
                unlink(public_path('content/images/Tours/'.$photo->tour_id.'/big/'.$photo->photo_path));
                Photo::find($photo->photo_id)->delete();
            endif;

        endforeach;


        return response()->json([1]);


    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletePhoto(Request $request) {

        $photo_id = explode('_', $request->input('photoId'));

        $photo = Photo::where('photo_id', $photo_id[1])->first();

        if (file_exists(public_path('content/images/Tours/'.$photo->tour_id.'/'.$photo->photo_path))):

            unlink(public_path('content/images/Tours/'.$photo->tour_id.'/'.$photo->photo_path));


        endif;

        if (file_exists(public_path('content/images/Tours/'.$photo->tour_id.'/big/'.$photo->photo_path))):

            unlink(public_path('content/images/Tours/'.$photo->tour_id.'/big/'.$photo->photo_path));

        endif;

        Photo::find($photo_id[1])->delete();

        return response()->json('order_'.$photo->photo_id);

    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function doImageGif(Request $request) {
        $photo_id = explode('_', $request->input('gifId'));

        $tour = Photo::where('photo_id', $photo_id[1])->first();

        Photo::where('tour_id', $tour->tour_id)->where('gif', 1)->update(['gif' => 0]);

        Photo::where('photo_id', $photo_id[1])->update(['gif' => 1]);

        return response()->json($photo_id[1]);

    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function doImageCover(Request $request) {

        $photo_id = explode('_', $request->input('coverId'));

        $tour = Photo::where('photo_id', $photo_id[1])->first();

        Photo::where('tour_id', $tour->tour_id)->where('cover', 1)->update(['cover' => 0]);

        Photo::where('photo_id', $photo_id[1])->update(['cover' => 1]);

        return response()->json($photo_id[1]);
    }

    /******************************************************************************
     * show district for tour
     * if tour not have district user can insert
     * @param  integer  $tourId
     ******************************************************************************
     */
    public function showTourDistrict($tourId) {

        $tour = Tour::where('tour_id', $tourId)->first();

    }

}
