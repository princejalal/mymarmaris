<?php

namespace App\Http\Middleware;

use App\Language;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class CheckLanguage {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if ($request->route()->getName() == 'home.index' && $request->lng == 'tr'):
            return redirect(route('home.index', 'en'));
        endif;

        if ($request->lng) {
            $language = Language::where('lang_short_name', $request->lng)->firstOrFail();
        } else {
            $language = Language::where('lang_short_name', 'en')->first();
        }

        App::setLocale($request->lng);

        Session::put('currency_id', $language->currency_id);

        $request->route()->forgetParameter('lng');

        return $next($request);
    }
}
