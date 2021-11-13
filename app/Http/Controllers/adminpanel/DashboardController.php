<?php

namespace App\Http\Controllers\adminpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends AdminController {


    public function index(){

        return view('adminpanel.layouts.app');

    }
}
