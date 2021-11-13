<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller {

    public function destinationEditorUpload(Request $request) {

        if ($request->hasFile('upload')):

            $orginName = $request->file('upload')->getClientOriginalName();

            $fileName = pathinfo($orginName, PATHINFO_FILENAME);

            $extention = $request->file('upload')->getClientOriginalExtension();

            $newName = md5($fileName) . time() . '.' . $extention;

            $request->file('upload')->move(public_path('/content/images/'), $newName);

            $url = '/public/content/images/' . $newName;

            if (file_exists(public_path() . '/content/images/' . $newName)):

                $response = ["uploaded" => 1, "filename" => $newName, "url" => $url];

            else:
                $response = ["uploaded" => 0, "filename" => '', "url" => '', "error" => ["message" => 'مشکلی پیش آمده مجددا تلاش کنید']];

            endif;

            echo json_encode($response);
        endif;
    }


}
