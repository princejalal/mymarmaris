<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\MyController;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends MyController {
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/adminpanel/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest')->except('logout', 'register');
    }

    public function showLoginForm() {
        $data = [
            'title'    => 'login',
            'metaDesc' => 'login',
            'metaTags' => 'login'
        ];

        return view('auth.login', $data);
    }
}
