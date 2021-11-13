<?php

namespace App\Http\Controllers\adminpanel;

use App\Http\Controllers\Controller;
use App\menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class MenuController extends AdminController {

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

        $menus = menu::orderBy('menu_position', 'ASC')->get();

        return view('adminpanel.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

        $kind = 'basic';
        $basicMenu = [];

        if ($request->segment(4) && $request->segment(4) == 'submenu'):
            $kind = 'submenu';
            $baseMenu = menu::where('submenu', 0)->orderBy('menu_id', 'ASC')->get();
            foreach ($baseMenu as $menu):
                $basicMenu[$menu->menu_id] = $menu->menu_name;
            endforeach;
        endif;

        return view('adminpanel.menu.create', compact('kind', 'basicMenu'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $data = $request->all();

        $this->validator($data)->validate();

        try {
            $submenu = 0;
            if (isset($data['submenu'])):
                $submenu = $data['submenu'];
            endif;

            menu::create(['menu_name' => $data['menu_name'], 'menu_icon' => $data['menu_icon'], 'menu_position' => $data['menu_position'], 'menu_link' => $data['menu_link'], 'submenu' => $submenu]);

            Session::flash('message', error_layout('menu save successfuly!'));
            return back();
        } catch (Exception $e) {
            Log::error($e);
            Session::flash('message', error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));
            return back();
        }

    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function validator($data) {
        return Validator::make($data, ['menu_name' => ['required', 'max:200', 'unique:admin_menu'], 'menu_icon' => ['required'], 'menu_link' => ['required'], 'menu_position' => ['required']]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id) {

        $kind = 'basic';
        $basicMenu = [];

        $menu = menu::where('menu_id', $id)->first();

        if ($menu->submenu != 0):
            $kind = 'submenu';
            $baseMenu = menu::where('submenu', 0)->orderBy('menu_id', 'ASC')->get();
            foreach ($baseMenu as $menus):
                $basicMenu[$menus->menu_id] = $menus->menu_name;
            endforeach;
        endif;


        return view('adminpanel.menu.edit', compact('menu', 'basicMenu', 'kind'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $data = $request->all();

        try {
            $submenu = 0;
            if (isset($data['submenu'])):
                $submenu = $data['submenu'];
            endif;

            menu::where('menu_id', $id)->update(['menu_name' => $data['menu_name'], 'menu_icon' => $data['menu_icon'], 'menu_position' => $data['menu_position'], 'menu_link' => $data['menu_link'], 'submenu' => $submenu]);

            Session::flash('message', error_layout('menu edit successfuly!'));
            return back();
        } catch (Exception $e) {
            Log::error($e);
            Session::flash('message', error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        menu::where('menu_id',$id)->delete();

        return response()->json([1]);
    }


    public function menuState($id) {
        $menu = menu::where('menu_id', $id)->first();

        if ($menu->publish == 1):
            menu::where('menu_id', $id)->update(['publish' => 0]);
            Session::flash('message', error_layout('menu now is deactive!!'));
        else:
            menu::where('menu_id', $id)->update(['publish' => 1]);
            Session::flash('message', error_layout('menu now is active!'));
        endif;

        return back();
    }
}
