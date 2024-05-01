<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

use  Illuminate\Support\Facades\App;
use Spatie\ImageOptimizer\OptimizerChainFactory;

Route::prefix('adminpanel')->middleware('auth')->group(function () {

    Route::get('admin.permission', function () {
        return view('adminpanel.layouts.permission');
    });

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

    Route::get('set/{name}/locale', 'adminpanel\AdminController@setAdminLocale')->name('set.admin.locale');

    Route::get('/', 'adminpanel\DashboardController@index');

    /*
   |--------------------------------------------------------------------------
   | manage menu routes
   |--------------------------------------------------------------------------
   */

    Route::resource('manageUser', 'adminpanel\UserController');


    /*
    |--------------------------------------------------------------------------
    | manage menu routes
    |--------------------------------------------------------------------------
    */
    Route::resource('menu', 'adminpanel\MenuController');

    Route::get('menu/create/submenu', 'adminpanel\MenuController@create')->name('menu.submenu');

    Route::get('menu/changeStatus/{id}', 'adminpanel\MenuController@menuState')->name('menu.state');

    /*
    |--------------------------------------------------------------------------
    | destination management routes
    |--------------------------------------------------------------------------
    */
    Route::resource('destination', 'adminpanel\DestinationController');

    Route::get('destination/changeStatus/{id}',
        'adminpanel\DestinationController@destState')->name('destination.state');

    Route::get('destination/{destId}/lang/{id}',
        'adminpanel\DestinationController@addDestinationInfo')->name('destInfo.store');

    Route::put('destination/update/{destId}',
        'adminpanel\DestinationController@updateDestinationInfo')->name('dest.info.update');

    Route::post('destination/update/{destId}',
        'adminpanel\DestinationController@createDestinationInfo')->name('dest.info.create');

    Route::post('destination/delete/{destId}',
        'adminpanel\DestinationController@deleteDestinationInfo')->name('distInfo.destroy');
    /*
    |--------------------------------------------------------------------------
    | destination management routes
    |--------------------------------------------------------------------------
    */
    Route::resource('districts', 'adminpanel\DistrictsController');

    Route::get('districts/{distId}/lang/{id}',
        'adminpanel\DistrictsController@addDistrictInfo')->name('distInfo.store');

    Route::get('districts/changeStatus/{id}', 'adminpanel\DistrictsController@districtState')->name('district.state');

    Route::put('districts/update/{distId}',
        'adminpanel\DistrictsController@updateDistrictInfo')->name('dist.info.update');

    Route::post('districts/update/{distId}',
        'adminpanel\DistrictsController@createDistrictInfo')->name('dist.info.create');

    Route::delete('districts/deleteInfo/{distId}',
        'adminpanel\DistrictsController@deleteDistrictInfo')->name('distInfo.destroy');

    /*
    |--------------------------------------------------------------------------
    | Districts management routes
    |--------------------------------------------------------------------------
    */
    Route::resource('languages', 'adminpanel\LangController');

    Route::get('languages/changeStatus/{id}', 'adminpanel\LangController@langState')->name('language.state');

    /*
    |--------------------------------------------------------------------------
    | Tours management routes
    |--------------------------------------------------------------------------
    */
    Route::resource('tours', 'adminpanel\TourController');

    Route::get('tour/changeName/{tourId}/lng/{lngId}',
        'adminpanel\TourController@changeName')->name('tours.destition.name');

    Route::get('tours/{destId?}/search', 'adminpanel\TourController@index')->name('tour.search');

    // show tour with districts
    Route::get('tours/{parentId}/withParent', 'adminpanel\TourController@showDistricts')->name('parent.show');
    // create tour with districts
    Route::get('tours/{distId}/dist/{parentId}/parent',
        'adminpanel\TourController@createWithDistricts')->name('create.with.district');

    Route::delete('tours/{distId}/DeleteWithdist/',
        'adminpanel\TourController@deleteWithDistricts')->name('destroy.with.district');

    Route::post('tours/deletePhoto', 'adminpanel\TourController@deletePhoto');

    Route::delete('/tous/photo/{id}/delete', 'adminpanel\TourController@deleteAllPhoto')->name('photo.all.destroy');

    Route::post('tours/doGif', 'adminpanel\TourController@doImageGif');

    Route::post('tours/doCover', 'adminpanel\TourController@doImageCover');

    Route::get('tours/changeState/{id}', 'adminpanel\TourController@changeState')->name('tours.state');

    // tour photo management
    Route::get('tours/{tourId}/photo', 'adminpanel\TourController@showTourPhoto')->name('tours.show.photo');

    Route::post('tours/tourId/uploadPhoto', 'adminpanel\TourController@uploadTourPhoto')->name('tour.upload.photo');

    /**
     *  tour info routes
     */
    Route::get('tours/{tourId}/lang/{id}', 'adminpanel\TourController@addTourInfo')->name('tourInfo.store');

    Route::put('tours/tourInfo/{distId}/update', 'adminpanel\TourController@updateTourInfo')->name('tour.info.update');

    Route::post('tours/tourInfo/{distId}/create', 'adminpanel\TourController@createTourInfo')->name('tour.info.create');

    Route::delete('tours/tourInfo/{id}/delete', 'adminpanel\TourController@InfoDestroy')->name('tour.info.destroy');

    /**
     * tour program routes
     */
    Route::get('tours/program/{tourId}/show}', 'adminpanel\ProgramController@show')->name('tours.show.program');

    Route::get('tours/program/{tourId}/lang/{langId}',
        'adminpanel\ProgramController@create')->name('tours.create.program');

    Route::post('tours/program/store', 'adminpanel\ProgramController@store')->name('tours.store.program');

    Route::put('tours/program/{tourId}/update', 'adminpanel\ProgramController@update')->name('tours.update.program');

    Route::delete('tours/program/{tourId}/delete',
        'adminpanel\ProgramController@destroy')->name('tours.delete.program');

    /************************************
     * Tour Prices
     * **********************************
     */

    Route::get('tours/prices/{TourId}', 'adminpanel\tourPriceController@index')->name('tours.price.index');

    Route::get('tours/prices/{TourId}/show', 'adminpanel\tourPriceController@show')->name('tours.price.show');

    Route::get('tours/prices/create/{TourId}', 'adminpanel\tourPriceController@create')->name('tours.price.create');

    Route::get('tours/prices/{priceId}/create/{TourId}',
        'adminpanel\tourPriceController@edit')->name('tours.price.edit');

    Route::post('tours/prices/create', 'adminpanel\tourPriceController@store')->name('tours.price.store');

    Route::put('tours/prices/{id}/update', 'adminpanel\tourPriceController@update')->name('tours.price.update');

    Route::delete('tours/prices/{id}/delete', 'adminpanel\tourPriceController@destroy')->name('tours.price.destroy');

    Route::put('tours/prices/{id}/change', 'adminpanel\tourPriceController@changePrice')->name('price.change');


    /******************************************************************
     * Manage Tour Tags
     *
     * *****************************************************************
     */
    Route::resource('tourTag', 'adminpanel\TagController');

    /******************************************************************
     * Geolocations management
     *
     * *****************************************************************
     */

    Route::get('locations', 'adminpanel\SiteController@location')->name('location.show');

    Route::put('locations/edit', 'adminpanel\SiteController@editLocation')->name('locations.update');


    /******************************************************************
     * Slider management
     *
     * *****************************************************************
     */

    Route::resource('slider', 'adminpanel\SliderController');

    Route::get('slider/changeStatus/{id}', 'adminpanel\SliderController@changeStatus')->name('slider.change');


    /******************************************************************
     * Currency(Money) Management
     *
     * *****************************************************************
     */

    Route::resource('currency', 'adminpanel\MoneyController');

    /******************************************************************
     * Pages Content Management
     *
     * *****************************************************************
     */

    Route::resource('pages', 'adminpanel\PageController');

    Route::get('pages/{pageId}/lang/{langId}', 'adminpanel\PageInfoController@create')->name('pages.create.info');

    Route::post('pages/info/store', 'adminpanel\PageInfoController@store')->name('pages.store.info');

    Route::put('pages/info/{tourId}/update', 'adminpanel\PageInfoController@update')->name('pages.update.info');

    Route::delete('pages/info/{tourId}/delete', 'adminpanel\PageInfoController@destroy')->name('pages.destroy.info');

    Route::get('pages/info/{tourId}/state', 'adminpanel\PageInfoController@changeState')->name('pages.change.state');


    /******************************************************************
     * Post Management
     *
     * *****************************************************************
     */
    Route::resource('post', 'adminpanel\PostController');


    /******************************************************************
     * Blog Management
     *
     * *****************************************************************
     */

    Route::resource('blogs', 'adminpanel\BlogController');


    /******************************************************************
     * Site Info Management
     *
     * *****************************************************************
     */

    Route::get('metas', 'adminpanel\SiteController@SiteInfo');

    Route::put('metas/{id}/update', 'adminpanel\SiteController@update')->name('metas.update');

    Route::get('contacts', 'adminpanel\SiteController@contact')->name('contact.index');

    Route::get('contacts/create', 'adminpanel\SiteController@createContact')->name('contact.create');

    Route::get('contacts/{id}/edit', 'adminpanel\SiteController@edit')->name('contact.edit');

    Route::post('contacts/store', 'adminpanel\SiteController@store')->name('contact.store');

    Route::delete('contacts/{id}/delete', 'adminpanel\SiteController@destroy')->name('contact.destroy');

    Route::put('contacts/{id}/update', 'adminpanel\SiteController@updateContact')->name('contact.update');

    Route::get('contacts/show', 'adminpanel\SiteController@socialMedia')->name('contact.shows');


    /******************************************************************
     * Tags Management
     *
     * *****************************************************************
     */
    Route::resource('tags', 'adminpanel\TagController');

    Route::resource('reservs', 'adminpanel\ReservController');

    Route::get('reservs/{id}/delete', 'adminpanel\ReservController@delete')->name('reservs.show.delete');

    /******************************************************************
     * message Management
     *
     * *****************************************************************
     */

    Route::resource('posts', 'adminpanel\PostController');
    /******************************************************************
     * Mobile Conetnt Management
     *
     * *****************************************************************
     */

    Route::resource('content', 'adminpanel\MobileContentController');

    /**
     * Messengers
     */
    Route::resource('messenger', 'adminpanel\Messenger\MessengerController')->except('show');

    Route::resource('messenger-type', 'adminpanel\Messenger\MessengerTypeController')->except('show', 'create', 'edit');

    /*
     * Language file editor
     */
    Route::get('lang_files','adminpanel\LangFileController@index')->name('files.index');

    Route::get('lang_files/show/{lng}/{file?}','adminpanel\LangFileController@show')->name('files.show');

    Route::put('lang_files/{key}/edit', 'adminpanel\LangFileController@update')->name('files.update');

});


/*
  |--------------------------------------------------------------------------
  | Image resize Routes
  |--------------------------------------------------------------------------
 */
Route::get('/pic/{w}/{h}/{img}/{id}/', function ($w, $h, $id, $img) {
    return Image::make(public_path("/content/images/Tours/$id/$img"))->resize($h, $w)->response('jpg');
});

Route::get('/blog/{w}/{h}/{img}/', function ($w, $h, $img) {
    return Image::make(public_path("/content/images/Blogs/$img"))->resize($h, $w)->response('jpg');
});

Route::get('/dest/{w}/{h}/{img}/', function ($w, $h, $img) {
    return Image::make(public_path("/content/images/Destinations/$img"))->response('jpg');
});

Route::get('/dist/{w}/{h}/{img}/', function ($w, $h, $img) {
    return Image::make(public_path("/content/images/District/big/$img"))->resize($h, $w)->response('jpg');
});

Route::get('/slider/{w}/{h}/{img}/', function ($w, $h, $img) {
    return Image::make(public_path("/content/images/slider/$img"))->response('jpg');
});


if (!app()->runningInConsole()):
    Route::redirect('/', "/en");
endif;


Route::group([
    'prefix'     => '{lng}',
    'middleware' => 'checkLng'
], function () {

    Auth::routes();

    Route::post('/app/upload', 'HomeController@upload')->name('app.upload');

    Route::get('sitemap.xml', 'HomeController@siteMap');

    Route::get('success', 'HomeController@success');

    Route::get('/', 'HomeController@index')->name('home.index');

    $langShortName = \Illuminate\Support\Facades\Request::segment(1);
    if (!app()->runningInConsole()):
        $pages = \App\Page_info::select('page_info.url', 'page_info.page_name', 'page_info.page_id')->where('page_id',
            '>', 2)->where('lang_id', get_lang_id($langShortName))->get();

        foreach ($pages as $page):

            Route::get("/".changeUrlStyle($page->url), 'PageController@index')->name('page.show.'.$page->page_id);

        endforeach;
    endif;

    if (!app()->runningInConsole()):
        $pagesKind = \App\Page_info::select('page_info.url', 'pages.kind', 'page_info.page_name',
            'page_info.page_id')->where('lang_id', get_lang_id($langShortName))->where('pages.kind', '!=',
            'general')->where('page_info.page_id', '>', 3)->leftJoin('pages', 'pages.page_id', '=',
            'page_info.page_id')->get();

        foreach ($pagesKind as $pagekind):

            Route::get("/".changeUrlStyle($pagekind->url),
                'HomeController@allTours')->name('page.kind.'.$pagekind->kind);

        endforeach;
    endif;

    Route::get('blog', 'BlogController@index')->name('blog.index');

    Route::get('contact', 'HomeController@contant')->name('contact.show');

    Route::get('{itemName}', 'ItemController@index')->name('item.show');

    Route::get('blog/{title}', 'BlogController@show')->name('blog.show');

    Route::post('/home/reserve', 'HomeController@reserv')->name('reserve.store');

    Route::Post('/home/post', 'HomeController@post')->name('post.store');

});


/*
|--------------------------------------------------------------------------
| admin panel routes
|--------------------------------------------------------------------------
|
|
*/
Route::post('destination/ckeditor', 'UploadController@destinationEditorUpload')->name('dest.upload');

Route::post('getDistricts', function (Request $request) {
    $district = DB::select('SELECT district_id,district_name FROM districts where destination_id = '.$request->destId);
    return response()->json($district);
});
