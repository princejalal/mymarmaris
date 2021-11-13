<?php

namespace App\Http\Controllers\adminpanel;

use App\Currency;
use App\Http\Controllers\Controller;
use App\Tour;
use App\Tour_price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class tourPriceController extends AdminController {


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($TourId) {

        $prices = Tour_price::where('tour_id', $TourId)->leftJoin('currency', 'currency.currency_id', '=', 'tour_price.currency_id')->get();

        $tour = Tour::where('tour_id', $TourId)->first();

        $currency = Currency::all();

        // if tour child is empty tour just for adult and passenger
        if ($tour->min_child == '' && $tour->max_child == ''):

            $age_range = ['adult', 'passenger'];

        else:

            $age_range = ['adult', 'child', 'infants', 'passenger'];

        endif;

        return view('adminpanel.tours.currency', compact('TourId', 'prices', 'currency', 'age_range', 'tour'));

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($TourId) {

        $curr = Currency::all();

        $caurrencies = [];

        foreach ($curr as $currency):

            $caurrencies[$currency->currency_id] = $currency->currency_name;

        endforeach;

        return view('adminpanel.tours.CurrencyCreate', compact('caurrencies', 'TourId'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {


        try {

            Tour_price::create($request->except('_method', '_token'));

            Session::flash('message', error_layout('Tour Price For ' . $request->input('age_range') . ' Save Successfuly!'));

            return back();

        } catch (Exception $e) {

            Log::error($e);

            Session::flash('message', error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));

            return back();
        }


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
    public function edit($priceId, $TourId) {
        $curr = Currency::all();

        $caurrencies = [];

        foreach ($curr as $currency):
            $caurrencies[$currency->currency_id] = $currency->currency_name;
        endforeach;

        $currenc = Currency::where('currency_id', $priceId)->first();

        $currency = Tour_price::where('tour_id', $TourId)->where('price_id', $priceId)->first();

        if ($currency):
            $currencyInfo = $currency;
        endif;

        return view('adminpanel.tours.editCurrency', compact('currencyInfo', 'TourId', 'priceId', 'currenc', 'caurrencies'));
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

            Tour_price::where('price_id', $id)->update($request->except('_method', '_token'));

            Session::flash('message', error_layout('Tour Price Update Successfuly!'));

            return redirect('/adminpanel/tours');

        } catch (Exception $e) {

            Log::error($e);

            Session::flash('message', error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));

            return redirect('/adminpanel/tours');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $tourPrice = Tour_price::find($id);

        $tourPrice->delete();

        Session::flash('message', error_layout('Tour Price Delete Successfully'));

        return response()->json([1]);

    }

    /**
     * @param $id
     */
    public function changePrice(Request $request, $id) {


        Tour_price::where('price_id', $id)->update(['price' => $request->input('price')]);
        try {
            Session::flash('message', error_layout('Price Change Successfuly '));
            return back();

        } catch (Exception $e) {

            Log::error($e);

            Session::flash('message', error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));

            return back();
        }


    }
}
