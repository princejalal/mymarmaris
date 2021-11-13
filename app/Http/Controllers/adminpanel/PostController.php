<?php

namespace App\Http\Controllers\adminpanel;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use mysql_xdevapi\Exception;

class PostController extends AdminController {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $posts = Message::paginate(10);

        return view('adminpanel.posts.index', compact('posts'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $post = Message::where('message_id', $id)->first();

        Message::where('message_id', $id)->update(['is_read' => 1]);

        $ipdat = file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $post->ip_address);

        return view('adminpanel.posts.details', compact('post', 'ipdat'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $post = Message::where('message_id',$id)->first();


        return view('adminpanel.posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        try {

            Message::where('message_id', $id)->update($request->except('_method', '_token'));
            Session::flash('message', error_layout('Post Edit Successfully'));
            return redirect('adminpanel/posts');

        } catch (Exception $e) {

            Log::error($e);
            Session::flash('message', error_layout('Whoops!There were some problems,please try few minute later', 'div', 'alert-danger'));
            return redirect('adminpanel/posts');

        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        Message::where('message_id', $id)->delete();

        Session::flash('message', error_layout('Post Delete Successfully'));

        return response()->json([1]);


    }
}
