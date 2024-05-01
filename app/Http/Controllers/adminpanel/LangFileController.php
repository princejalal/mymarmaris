<?php

namespace App\Http\Controllers\adminpanel;

use App\Http\Controllers\Controller;
use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LangFileController extends AdminController {


    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view('adminpanel.lang.index', ['languages' => Language::all()]);
    }


    public function show($lng,$file = null) {

        if ($file != null) {
            $langFile = base_path('resources/lang/' . $lng . "/$file");
            if (!file_exists($langFile)) {
                $langDirectory = base_path('resources/lang/' . $lng);
                if (!is_dir($langDirectory)) {
                    mkdir($langDirectory);
                }
                copy(base_path("resources/lang/en/$file"), $langFile);
            }
            $lang = include $langFile;
            return view('adminpanel.lang.edit', [
                'lang' => $lang,
                'file' => $file,
                'lng'  => $lng
            ]);
        }

        $files = array_diff(scandir("resources/lang/en"), array('.', '..'));
        return view('adminpanel.lang.show',compact('files','lng'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     */
    public function update(Request $request, $id)
    {

        if ($request->lng != null && file_exists(base_path('resources/lang/' . $request->lng . "/$request->file"))) {
            $file = include base_path('resources/lang/' . $request->lng . "/$request->file");
            if (array_key_exists($id, $file)) {
                $res = array_replace($file, [$id => $request->value_name]);

                file_put_contents(base_path('resources/lang/' . $request->lng . "/$request->file"),
                    '<?php return ' . var_export($res, true) . ';');
                Session::flash('message',
                    error_layout('Word Edit Successfully', 'div'));
                return redirect(route('files.show', [$request->lng]));
            }
        } else {
            return redirect()->back();
        }


    }

}
