<?php

namespace App\Http\Controllers;

use App\Page_info;
use App\Pages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PageController extends MyController {


    public function index(Request $request) {

        $pageName = $request->segment(2);

        $name = str_replace('-', ' ', $pageName);

        $pageInfo = Page_info::where('lang_id', get_lang_id(App::getLocale()))->where('url', $name)->orWhere('url',$pageName)->first();

        $scrollText = $pageInfo->scrolling_text;

        $allPages = Page_info::select('page_info.url','page_info.page_name','page_info.page_id')->where('page_id', '>', 2)->where('lang_id',get_lang_id(App::getLocale()))->get();

        if (!$pageInfo):
            abort(404);
        endif;

        $title = $pageInfo->title;

        $metaDesc = $pageInfo->meta_desc;

        $metaTags = $pageInfo->meta_tags;

        return view('home.pages',compact('pageInfo','scrollText','allPages','title','metaDesc','metaTags'));


    }
}
