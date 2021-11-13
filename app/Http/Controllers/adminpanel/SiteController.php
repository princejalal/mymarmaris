<?php

namespace App\Http\Controllers\adminpanel;

use App\Contact_info;
use App\Http\Controllers\Controller;
use App\Language;
use App\Site_info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SiteController extends AdminController {

    public function SiteInfo() {

        $siteInfo = Site_info::where('id', 1)->first();

        return view('adminpanel.siteinfo.meta', compact('siteInfo'));

    }

    /**
     * @param  Request  $request
     * @param $id
     */
    public function update(Request $request, $id) {

        try {
            Site_info::where('id', $id)->update($request->except('_method', '_token'));
            Session::flash('message', error_layout('Site info update successfuly!'));
            return redirect('/adminpanel/metas');
        } catch (Exception $e) {
            Log::error($e);
            Session::flash('message',
                error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));
            return redirect('/adminpanel/metas');
        }


    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contact() {

        $contacts = Contact_info::select('contact_info.*', 'language.lang_short_name')->where('kind', '!=',
                'socialMedia')->leftJoin('language', 'language.lang_id', '=', 'contact_info.lang_id')->paginate(15);


        return view('adminpanel.siteinfo.contact', compact('contacts'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createContact() {

        $contactInfo = new \stdClass();

        $kind = [
            'Phone'   => 'Phone',
            'email'   => 'email',
            'address' => 'address'
        ];

        $langs = [];

        foreach ($this->languages as $language):

            $langs[$language->lang_id] = $language->lang_short_name;

        endforeach;

        return view('adminpanel.siteinfo.create', compact('kind', 'langs', 'contactInfo'));

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function socialMedia() {

        $socialMedia = [
            [
                'name' => 'facebook',
                'icon' => 'fab fa-facebook'
            ],
            [
                'name' => 'twitter',
                'icon' => 'fab fa-twitter'
            ],
            [
                'name' => 'youtube',
                'icon' => 'fab fa-youtube'
            ],
            [
                'name' => 'instagram',
                'icon' => 'fab fa-instagram'
            ],
            [
                'name' => 'ok',
                'icon' => 'fab fa-odnoklassniki-square'
            ],
            [
                'name' => 'vk',
                'icon' => 'fab fa-vk'
            ],
            [
                'name' => 'telegram',
                'icon' => 'fab fa-telegram-plane'
            ],
            [
                'name' => 'whatsapp',
                'icon' => 'fab  fa-whatsapp'
            ]
        ];

        $language = Language::where('publish', 1)->get();

        return view('adminpanel.siteinfo.social', compact('socialMedia', 'language'));
    }

    /*****
     * @param  Request  $request
     */
    public function store(Request $request) {

        Validator::make($request->all(), [
            'name'          => [
                'required',
                'max:200'
            ],
            'contact_value' => [
                'required',
                'max:300'
            ]
        ])->validate();

        try {

            Contact_info::create($request->except('_method', '_token'));

            Session::flash('message', error_layout('Contact Info Save successfuly!'));

            return back();

        } catch (Exception $e) {

            Log::error($e);

            Session::flash('message',
                error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));

            return back();
        }


    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) {

        $contactInfo = Contact_info::where('contact_id', $id)->first();


        $kind = [
            'Phone'   => 'Phone',
            'email'   => 'email',
            'address' => 'address'
        ];

        $langs = [];
        foreach ($this->languages as $language):

            $langs[$language->lang_id] = $language->lang_short_name;

        endforeach;

        return view('adminpanel.siteinfo.create', compact('kind', 'langs', 'contactInfo'));

    }

    /**
     * @param  Request  $request
     * @param $id
     */
    public function updateContact(Request $request, $id) {
        Validator::make($request->all(), [
            'name'          => [
                'required',
                'max:200'
            ],
            'contact_value' => [
                'required',
                'max:300'
            ]
        ])->validate();
        try {
            Contact_info::where('contact_id', $id)->update($request->except('_method', '_token'));
            Session::flash('message', error_layout('Contact Info update successfuly!'));
            return back();
        } catch (Exception $e) {
            Log::error($e);
            Session::flash('message',
                error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));
            return back();
        }
    }


    /**
     * @param $id
     */
    public function destroy($id) {

        $contact = Contact_info::find($id);

        $contact->delete();

        Session::flash('message', error_layout('Contact Info Delete successfuly!'));

        return response()->json([1]);

    }

    public function location() {

        $locationInfo = DB::table('location_table')->where('location_id', 1)->first();

        return view('home.location', compact('locationInfo'));


    }

    public function editLocation(Request $request) {

        DB::table('location_table')->where('location_id', 1)->update($request->except('_method', '_token'));
        Session::flash('message', error_layout('Location Info update successfuly!'));
        return redirect('/adminpanel/locations');

    }

}
