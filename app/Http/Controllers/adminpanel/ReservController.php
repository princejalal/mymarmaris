<?php

namespace App\Http\Controllers\adminpanel;

use App\Http\Controllers\Controller;
use App\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class ReservController extends AdminController {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $reservs = Reserve::select('reserv_table.*', 'tour.tour_name')->leftJoin('tour', 'tour.tour_id', '=',
            'reserv_table.tour_id')->orderBy('reserv_table.created_at', 'DESC')->paginate(15);

        return view('adminpanel.reserve.index', compact('reservs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $reserv = Reserve::where('reserve_id', $id)
            ->leftJoin('tour','tour.tour_id','=','reserv_table.tour_id')
            ->first();

        Reserve::where('reserve_id', $id)->update(['is_read'=>1]);

        $ipdat = file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $reserv->ip_address);


        return view('adminpanel.reserve.details', compact('reserv', 'ipdat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $reserv = Reserve::where('reserve_id', $id)->first();


        return view('adminpanel.reserve.edit', compact('reserv'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        try {

            Reserve::where('reserve_id', $id)->update($request->except('_method', '_token'));

            Session::flash('message', error_layout('Reservation Update Successfuly!'));
            return redirect('/adminpanel/reservs');

        } catch (Exception $e) {
            Log::error($e);
            Session::flash('message',
                error_layout('Whoops!There were some problems,please try few minute later', 'div', 'danger-color'));
            return redirect('/adminpanel/reservs');
        }


    }


    public function delete($id) {
        $reserv = Reserve::where('reserve_id', $id)->first();

        $ipdat = file_get_contents("http://www.geoplugin.net/json.gp?ip=".$reserv->ip_address);


        return view('adminpanel.reserve.delete', compact('reserv', 'ipdat'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {

        Reserve::where('reserve_id', $id)->delete();

        Session::flash('message', error_layout('Reservation Delete Successfuly!'));

        return response()->json([1]);
    }
}
