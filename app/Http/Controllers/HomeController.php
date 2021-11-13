<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Contact_info;
use App\Destination_info;
use App\Destinations;
use App\District;
use App\District_info;
use App\Mail\ResevreMail;
use App\Mail\ContactMail;
use App\Mail\SendMail;
use App\Message;
use App\Mobile_content;
use App\Page_info;
use App\Pages;
use App\Reserve;
use App\Slider;
use App\Tour;
use App\Tour_info;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Exception;

class HomeController extends MyController {

    public function index() {

        $dests = Destinations::where('publish', 1)->select('destinations.image', 'destination_info.*',
            'destination_info.destination_name as dest_name')->where('destination_info.lang_id',
            get_lang_id(App::getLocale()))->leftJoin('destination_info', 'destination_info.destination_id', '=',
            'destinations.destination_id')->orderBy('order', 'ASC')->get();

        $tagId = 'tag_id';
        if (App::getLocale() != 'en'):
            $tagId = 'parent';
        endif;

        $tours = Tour::select('tour.*', 'tour_photo.photo_path', 'tour_price.price', 'tour_price.currency_id',
            'tour_info.url', 'tour_info.tour_name as t_name', 'tour_info.tour_header', 'tour_info.tour_explain',
            'tourGif.gif', DB::raw('IFNULL(tourTag.tName,null) as tag_name'))->where('publish', 1)->where('parent_id',
            0)->where('tour_info.lang_id', get_lang_id(App::getLocale()))->where('tour_price.age_range',
            'adult')->where('tour_photo.cover', 1)->where('tour_price.currency_id',
            Session::get('currency_id'))->leftJoin('tour_info', 'tour_info.tour_id', '=',
            'tour.tour_id')->leftJoin('tour_photo', 'tour_photo.tour_id', '=',
            'tour.tour_id')->leftJoin(DB::raw('(SELECT tag_id,tag_name as tName,parent FROM tour_tag WHERE lang_id = '.get_lang_id(App::getLocale()).') tourTag'),
            DB::raw('tourTag.'.$tagId), '=',
            'tour.tour_tag')->leftJoin(DB::raw('(SELECT photo_id,tour_id,photo_path as gif FROM tour_photo WHERE gif = 1) tourGif'),
            DB::raw('tourGif.tour_id'), '=', 'tour.tour_id')->leftJoin('tour_price', 'tour_price.tour_id', '=',
            'tour.tour_id')->groupBy('tour.tour_id')->get();

        $blogs = Blog::where('publish', 1)->where('lang_id', get_lang_id(App::getLocale()))->orderBy('created_at','DESC')->get();

        $content = new \stdClass();

        $content = Mobile_content::where('lang_id', get_lang_id(App::getLocale()))->first();

        $homePageInfo = Page_info::where('page_id', 1)->where('lang_id', get_lang_id(App::getLocale()))->first();

        $title = $homePageInfo->title;
        $metaDesc = $homePageInfo->meta_desc;
        $metaTags = $homePageInfo->meta_tags;

        return view('home.index',
            compact('dests', 'tours', 'sliders', 'title', 'content', 'blogs', 'metaTags', 'metaDesc'));
    }

    /**
     * set session for currency id
     *
     * @param  integer  $id
     */
    public function setCurrency($id) {

        Session::put('currency_id', $id);

        return back();

    }

    public function reserv(Request $request) {

        Validator::make($request->all(), [
            'name'                 => ['required'],
            'g-recaptcha-response' => [
                'required',
                'captcha'
            ],
            'email'                => [
                'required',
                'email'
            ],
            'tour_date'            => ['required'],
        ])->validate();
        // $this->sendEmail($request->all());

        try {

            $res = Reserve::create($request->except('_method', '_token'));

            $reserve = Reserve::select('reserv_table.*', 'tour_info.tour_header')->where('reserve_id',
                $res->reserve_id)->where('tour_info.lang_id', get_lang_id(App::getLocale()))->leftJoin('tour_info',
                'tour_info.tour_id', '=', 'reserv_table.tour_id')->first();

            $users = User::where('user_role', 'Admin')->get();

            foreach ($users as $key => $value):

                Mail::to($users[$key]->email)->send(new ResevreMail($reserve));

            endforeach;

            Mail::to($request->input('email'))->send(new ResevreMail($reserve));

            return redirect(App::getLocale().'/success');

        } catch (Exception $e) {
            Log::error($e);
            Session::flash('message',
                error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));
            return back();
        }


    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contant() {


        $phones = Contact_info::where('kind', 'Phone')->get();

        $socialMedia = Contact_info::where('kind', 'socialMedia')->get();
        $address = Contact_info::where('kind', 'address')->get();
        $emailes = Contact_info::where('kind', 'email')->get();
        $geoLocations = DB::table('location_table')->where('location_id', 1)->first();

        $title = locale_words('ContactTitle');

        $metaDesc = locale_words('ContactDesc');

        $metaTags = locale_words('ContactTags');

        return view('home.contact',
            compact('phones', 'socialMedia', 'address', 'emailes', 'geoLocations', 'title', 'metaDesc', 'metaTags'));

    }

    /**
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function post(Request $request) {


        Validator::make($request->all(), [
            'name'                 => ['required'],
            'email'                => [
                'required',
                'email'
            ],
            'g-recaptcha-response' => [
                'required',
                'captcha'
            ],
            'message'              => [
                'required',
                'max:1000'
            ]
        ])->validate();


        try {

            $cont = Message::create($request->except('_method', '_token'));

            $reserve = Message::where('message_id', $cont->message_id)->first();


            Mail::to('mymartours@gmail.com')->send(new ContactMail($reserve));

            Session::flash('message', error_layout('Your Message Send successfuly!'));
            return back();

        } catch (Exception $e) {

            Log::error($e);
            Session::flash('message',
                error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));
            return back();

        }
    }


    public function siteMap() {

        $data = [
            'tours' => Tour_info::where('lang_id', get_lang_id(App::getLocale()))->get(),
            'pages' => Page_info::where('lang_id', get_lang_id(App::getLocale()))->where('page_id', '>', 2)->get(),
            'blogs' => Blog::where('lang_id', get_lang_id(App::getLocale()))->get(),
            'dests' => Destination_info::where('lang_id', get_lang_id(App::getLocale()))->get(),
        ];

        return response()->view('home.sitemap', $data)->header('Content-Type', 'text/xml');

    }


    public function upload(Request $request) {

        if ($request->hasFile('image')):

            $orginName = $request->file('image')->getClientOriginalName();

            $fileName = pathinfo($orginName, PATHINFO_FILENAME);

            $extention = $request->file('image')->getClientOriginalExtension();

            $newName = md5($fileName).time().'.'.$extention;

            // move_uploaded_file$_FILES["fileToUpload"]["tmp_name"],public_path('content/') . $newName);

            $request->file('image')->move(public_path('content/'), $newName);


        endif;


    }

    public function allTours(Request $request) {

        $url = $request->segment(2);

        $page = Page_info::select('page_info.*', 'pages.kind')->where('page_info.lang_id',
            get_lang_id(App::getLocale()))->where('page_info.url', $url)->leftJoin('pages', 'pages.page_id', '=',
            'page_info.page_id')->first();


        $tours = Tour::select('tour.*', 'tour_photo.photo_path', 'tour_price.price', 'tour_price.currency_id',
            'tour_info.url', 'tour_info.tour_name as t_name', 'tour_info.tour_header', 'tour_info.tour_explain',
            'tourGif.gif')->where('tour.kind',
            $page->kind)->where('publish', 1)->where('parent_id', 0)->where('tour_price.currency_id',
            Session::get('currency_id'))->where('tour_info.lang_id',
            get_lang_id(App::getLocale()))->where('tour_price.age_range', 'adult')->where('tour_photo.cover',
            1)->leftJoin('tour_info', 'tour_info.tour_id', '=', 'tour.tour_id')->leftJoin('tour_photo',
            'tour_photo.tour_id', '=',
            'tour.tour_id')->leftJoin(DB::raw('(SELECT photo_id,tour_id,photo_path as gif FROM tour_photo WHERE gif = 1) tourGif'),
            DB::raw('tourGif.tour_id'), '=', 'tour.tour_id')->leftJoin('tour_price', 'tour_price.tour_id', '=',
            'tour.tour_id')->groupBy('tour.tour_id')->get();


        $pageInfo = $page;


        $title = '';
        $scrollText = '';
        $metaDesc = '';
        $metaTags = '';

        if (isset($pageInfo->title)):
            $title = $pageInfo->title;
            $scrollText = $pageInfo->scrolling_text;
            $metaDesc = $pageInfo->meta_desc;
            $metaTags = $pageInfo->meta_tags;
        endif;

        return view('home.allTours', compact('tours', 'title', 'pageInfo', 'scrollText', 'metaTags', 'metaDesc'));

    }

    public function success() {
        return view('success', [
            'title'    => '',
            'metaDesc' => '',
            'metaTags' => ''
        ]);
    }

}

