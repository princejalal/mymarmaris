<?php

namespace App\Providers;

use App\Contact_info;
use App\Currency;
use App\Language;
use App\Page_info;
use App\Pages;
use App\Site_info;
use App\Tour;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{

    protected $langId = [];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Schema::defaultStringLength(191);
        Paginator::useBootstrap();

        if (!app()->runningInConsole()):

            $request = $this->app->request;

            $languages = Language::where('publish', 1)
                ->get();
            $currency = Currency::all();
            $siteInfo = Site_info::where('id', 1)
                ->first();

            $pageInfoEng = Page_info::where('page_id', 1)
                ->where('lang_id', 1)
                ->first();

            $homeData = Page_info::where('page_id', 1)
                ->where('lang_id', get_lang_id($request->segment(1)))
                ->first();

            (isset($homeData->scrolling_text)) ?
                $scrollText = $homeData->scrolling_text :
                $scrollText = '$pageInfoEng->scrolling_text';

            $contactSocial = Contact_info::where('kind', 'socialMedia')
                ->where('lang_id', get_lang_id($request->segment(1)))
                ->get();

            (check_is_mobile()) ?
                $logo = 'logo-mobile.png' :
                $logo = 'logo.png';

            $socialLink = [
                'facebook'  => 'https://www.facebook.com/',
                'twitter'   => 'https://twitter.com/',
                'instagram' => 'https://www.instagram.com/',
                'vk'        => 'https://vk.com/',
                'youtube'   => 'https://youtube.com/',
                'whatsapp'  => 'https://web.whatsapp.com/',
                'telegram'  => 'https://t.me/'
            ];
            $phone = Contact_info::where('kind', 'phone')
                ->where('lang_id',get_lang_id($request->segment(1)))
                ->first();

            $address = Contact_info::where('kind', 'address')
                ->get();

            $emailess = Contact_info::where('kind', 'email')
                ->get();

            $pageKind = [
                'general'    => 'general',
                'child'      => 'child',
                'history'    => 'history',
                'district'   => 'district',
                'recreation' => 'recreation',
                'sea'        => 'sea'
            ];

            View::share('languages', $languages);
            View::share('currency', $currency);
            View::share('siteInfo', $siteInfo);
            View::share('pageInfoEng', $pageInfoEng);
            View::share('ViewLang', $this->langId);
            View::share('homeData', $homeData);
            View::share('scrollText', $scrollText);
            View::share('contactSocial', $contactSocial);
            View::share('socialLink', $socialLink);
            View::share('phone', $phone);
            View::share('address', $address);
            View::share('emailess', $emailess);
            View::share('pageKind', $pageKind);
            View::share('logo', $logo);

        endif;

    }
}
