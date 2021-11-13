<?php

namespace App\Http\Controllers\adminpanel;

use App\Blog;
use App\Destinations;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BlogController extends AdminController {

    protected $lang = [];
    protected $dest = [];

    public function __construct() {
        parent::__construct();

        foreach ($this->languages as $language):
            $this->lang[$language->lang_id] = $language->lang_short_name;
        endforeach;


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $posts = Blog::select('blog.*','language.*')->leftJoin('language', 'language.lang_id', '=', 'blog.lang_id')->paginate(15);

        return view('adminpanel.blog.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $blogInfo = new \stdClass();

        $lang = $this->lang;

        return view('adminpanel.blog.create', compact( 'lang', 'blogInfo'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {


        $this->validator($request->all())->validate();

        $image = $this->uploadImageWithResize($request, 'image', 'content/images/Blogs/', 'content/images/Blogs/big', 500, 280, false, $request->input('title') . '_' . time());

        try {
            Blog::create($request->except('_method', '_token', 'image') + ['image' => $image]);
            Session::flash('message', error_layout('Blog Post save successfuly!'));
            return redirect('/adminpanel/blogs');
        } catch (Exception $e) {
            Log::error($e);
            Session::flash('message', error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));
            return redirect('/adminpanel/blogs');
        }


    }

    /********************************************
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     ********************************************
     */
    protected function validator($data) {

        return Validator::make($data, ['title' => ['required', 'max:250','unique:blog'], 'content' => ['required', 'min:200'], 'image' => ['image','required'], 'summary' => ['max:300']]);

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
        $blogInfo = Blog::where('blog_id', $id)->first();

        $lang = $this->lang;

        return view('adminpanel.blog.create', compact('lang', 'blogInfo'));

    }

    /********************************************
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     ********************************************
     */
    protected function Editvalidator($data) {

        return Validator::make($data, ['title' => ['required', 'max:250'], 'content' => ['required', 'min:200'], 'summary' => ['max:300']]);

    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $this->Editvalidator($request->all())->validate();

        $blogPost = Blog::where('blog_id', $id)->first();

        $image = $blogPost->image;

        if ($request->hasFile('image')):

            if (file_exists(public_path('content/images/Blogs/big/' . $image))):

                unlink(public_path('content/images/Blogs/big/' . $image));

            endif;

            $image = $this->uploadImageWithResize($request, 'image', 'content/images/Blogs/', 'content/images/Blogs/big', 500, 280, false, $request->input('title'));

        endif;

        try {
            Blog::where('blog_id', $id)->update($request->except('_method', '_token', 'image') + ['image' => $image]);
            Session::flash('message', error_layout('Blog Post update successfuly!'));
            return redirect('/adminpanel/blogs');
        } catch (Exception $e) {
            Log::error($e);
            Session::flash('message', error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));
            return redirect('/adminpanel/blogs');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $post = Blog::find($id);

        if (file_exists(public_path('content/images/Blogs/' . $post->image))):
            unlink(public_path('content/images/Blogs/' . $post->image));
        endif;

        $post->delete();

        Session::flash('message', error_layout('Blog Post Delete successfuly!'));

        return response()->json([1]);
    }
}
