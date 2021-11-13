<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Destination_info;
use App\Destinations;
use App\Page_info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class BlogController extends MyController {


    public function __construct(Request $request) {
        parent::__construct($request);
    }


    public function index(Request $request) {

        $posts = Blog::where('publish', 1)->where('lang_id', get_lang_id(App::getLocale()))->orderBy('created_at',
            'DESC')->paginate(10);

        $lastedPost = Blog::where('publish', 1)->where('lang_id', get_lang_id(App::getLocale()))->orderBy('created_at',
            'DESC')->paginate(10);


        if ((!empty($_GET) && count($posts) == 0) || (!empty($_GET) && !array_key_exists($posts->getPageName(),
                    $_GET))):

            return abort(404);

        endif;
        $blogInfo = new \stdClass();
        $blogInfo = Page_info::where('page_id', 2)->where('lang_id', get_lang_id(App::getLocale()))->first();

        $title = ($request->get('page') != 1 && $request->get('page') != '') ? locale_words('Blog Title').' '.$request->get('page') : check_property($blogInfo,
            'title');
        $metaDesc = check_property($blogInfo, 'meta_desc');
        $metaTags = check_property($blogInfo, 'meta_tags');

        return view('blog.base', compact('posts', 'blogInfo', 'title', 'metaDesc', 'metaTags', 'lastedPost'));

    }


    public function show($title) {

        if (!empty($_GET)):

            return abort(404);

        endif;

        $name = str_replace('-', ' ', $title);

        $blogContent = Blog::where('title', $name)->where('lang_id', get_lang_id(App::getLocale()))->firstOrFail();


        $lastedPost = Blog::where('publish', 1)->where('lang_id', get_lang_id(App::getLocale()))->orderBy('created_at',
            'DESC')->paginate(10);


        Blog::where('blog_id', $blogContent->blog_id)->update(['view' => DB::raw('view + 1')]);

        $title = $blogContent->title;
        $metaDesc = $blogContent->summary;
        $metaTags = implode(',', explode(' ', $blogContent->title));

        $itemImage = asset('content/images/Blogs/'.$blogContent->image);

        return view('blog.show', compact('blogContent', 'title', 'metaTags', 'metaDesc', 'lastedPost','itemImage'));
    }

}
