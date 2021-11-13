<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Destinations;
use App\Language;
use App\Page_info;
use App\Pages;
use App\Site_info;
use App\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class MyController extends Controller {



    public function __construct(Request $request) {

        $pages = Pages::select('pages.*', 'page_info.lang_id', 'page_info.page_name as p_name',
            'page_info.url')->where('page_info.url', '!=', '')
            ->where('page_info.lang_id',get_lang_id($request->lng))
            ->where('page_info.page_id', '>',2)
            ->where('pages.publish', 1)
            ->leftJoin('page_info', 'page_info.page_id', '=', 'pages.page_id')->groupBy('pages.page_id')->get();

        $allTours = Tour::select('tour.*','tour_info.url','tour_info.tour_header','tour_info.tour_name')
            ->where('publish',1)->where('tour_info.url','!=','')
            ->where('tour_info.lang_id',get_lang_id($request->lng))
            ->leftJoin('tour_info','tour_info.tour_id','=','tour.tour_id')
            ->orderBy('order','ASC')->groupBy('tour.tour_id')->get();

        $destinations = Destinations::select('destinations.*','destination_info.url','destination_info.menu_header')
            ->where('publish',1)->where('destination_info.url','!=','')
            ->where('destination_info.lang_id',get_lang_id($request->lng))
            ->leftJoin('destination_info','destination_info.destination_id','=','destinations.destination_id')->get();

        $footerTours = Tour::select('tour.*','tour_info.url','tour_info.tour_header')
            ->where('publish',1)->where('ShowRecommended',1)
            ->where('tour_info.url','!=','')
            ->where('tour_info.lang_id',get_lang_id($request->lng))
            ->leftJoin('tour_info','tour_info.tour_id','=','tour.tour_id')
            ->limit(5)->get();

        $suggest = Tour::select('tour.*','tour_info.url','tour_info.tour_header')
            ->where('publish',1)->where('mostPreferred',1)
            ->where('tour_info.url','!=','')
            ->where('tour_info.lang_id',get_lang_id($request->lng))
            ->leftJoin('tour_info','tour_info.tour_id','=','tour.tour_id')
            ->limit(5)->get();



        View::share('pages',$pages);
        View::share('allTours',$allTours);
        View::share('destinations',$destinations);
        View::share('footerTours',$footerTours);
        View::share('suggest',$suggest);

    }


}
