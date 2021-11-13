<?php

namespace App\Http\Controllers\adminpanel;

use App\Currency;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MoneyController extends AdminController {
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

        $currencies = Currency::all();

        return view('adminpanel.currency.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('adminpanel.currency.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        try {
            Currency::create($request->except('_method', '_token'));
            Session::flash('message', error_layout('Currency save successfuly!'));
            return redirect('/adminpanel/currency');
        } catch (Exception $e) {
            Log::error($e);
            Session::flash('message', error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));
            return redirect('/adminpanel/currency');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $currency = Currency::where('currency_id', $id)->first();

        return view('adminpanel.currency.edit', compact('currency'));
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
            Currency::where('currency_id', $id)->update($request->except('_method', '_token'));
            Session::flash('message', error_layout('Currency update successfuly!'));
            return redirect('/adminpanel/currency');
        } catch (Exception $e) {
            Log::error($e);
            Session::flash('message', error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));
            return redirect('/adminpanel/currency');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        $currency = Currency::find($id);

        $currency->delete();

        Session::flash('message', error_layout('Currency Delete successfuly!'));

        return response()->json([1]);

    }
}
