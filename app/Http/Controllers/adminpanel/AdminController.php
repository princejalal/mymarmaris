<?php

namespace App\Http\Controllers\adminpanel;

use App\Http\Controllers\Controller;
use App\Language;
use App\menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Intervention\Image\ImageManagerStatic as Image;

class AdminController extends Controller {

    protected $languages;

    public function __construct() {


        if (!Session::get('lang_short_name')):

            Session::put('lang_short_name', 'en');

        endif;


        App::setLocale(Session::get('lang_short_name'));

        $sideMenus = menu::where('publish', 1)->where('submenu', 0)->orderBy('menu_position', 'ASC')->get();

        foreach ($sideMenus as $menu) :

            // Fetch sub menu from menu id
            $hasSub = menu::where('submenu', $menu->menu_id)->get();

            if ($hasSub):

                $menu->submenus = $hasSub;

            endif;

        endforeach;


        $languages = Language::where('publish', 1)->get();

        $this->languages = $languages;


        $kinds = [
            'child'      => __('category.child'),
            'history'    => __('category.history'),
            'district'   => __('category.district'),
            'recreation' => __('category.recreation'),
            'sea'        => __('category.sea')
        ];

        $pageKind = [
            'general'    => 'general',
            'child'      => __('category.child'),
            'history'    => __('category.history'),
            'district'   => __('category.district'),
            'recreation' => __('category.recreation'),
            'sea'        => __('category.sea')
        ];

        View::share('sideMenus', $sideMenus);
        View::share('languages', $languages);
        View::share('kinds', $kinds);
        View::share('pageKind', $pageKind);

    }


    protected function uploadImage($request, $name, $destination) {

        if ($request->hasFile($name)):

            $orginName = $request->file($name)->getClientOriginalName();

            $fileName = pathinfo($orginName, PATHINFO_FILENAME);

            $extention = $request->file($name)->getClientOriginalExtension();

            $newName = md5($fileName).time().'.'.$extention;


            $request->file($name)->move(public_path($destination), $newName);

            return $destination.$newName;

        endif;

    }


    protected function uploadImageWithResize($request, $name, $smallDestination, $largeDestination, $width = null, $height = null, $fullName = false, $newNames = '') {

        if ($request->hasFile($name)):

            $orginName = $request->file($name)->getClientOriginalName();

            $fileName = pathinfo($orginName, PATHINFO_FILENAME);

            $extention = $request->file($name)->getClientOriginalExtension();

            if ($newNames):

                $nameWithDash = str_replace(' ', '-', $newNames);

                $newName = $nameWithDash.'.'.$extention;
            else:

                $newName = md5($fileName).time().'.'.$extention;

            endif;


            $img = Image::make($request->file($name)->getRealPath());

            $watermarkSmall = Image::make(public_path('content/images/watermarker.png'))->resize(50, 50)->opacity(30);

            $img->insert($watermarkSmall, 'bottom-right', 10, 10);

            if (!file_exists(public_path($largeDestination))):

                mkdir(public_path($largeDestination), 0755, true);

            endif;
            if (!file_exists(public_path($smallDestination.'/large'))):

                mkdir(public_path($smallDestination.'/large'), 0755, true);

            endif;

            // resize to large size
            $img->resize(1920, 480)->save(public_path($smallDestination).'/large/'.$newName);

            // resize to small size
            $img->resize($width, $height)->save(public_path($smallDestination).'/'.$newName);

            $imgRealSize = Image::make($request->file($name)->getRealPath());
            // change water mark for big size
            $watermark = Image::make(public_path('content/images/watermarker.png'))->resize(80, 80)->opacity(30);

            $imgRealSize->insert($watermark, 'bottom-right', 10, 10);

            // upload with orginal size
            $imgRealSize->save(public_path($largeDestination).'/'.$newName);

            if ($fullName == true):
                return $smallDestination.'/'.$newName;
            endif;

            return $newName;
        endif;
    }


    /**
     * check section has language information or not
     * @param $langs object
     * @param $dest_info object
     * @return array
     */
    protected function checkLanguageInfo($langs, $information) {
        foreach ($langs as $key => $value):
            foreach ($information as $info):
                if ($langs[$key]->lang_id == $info->lang_id):
                    $langs[$key]->haslang = 1;
                    break;
                endif;
                $langs[$key]->haslang = 0;
            endforeach;
        endforeach;

        return $langs;
    }


    public function setAdminLocale($name) {

        Session::put('lang_short_name', $name);

        return back();

    }

}
