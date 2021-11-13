<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class CheckRole {
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        if (Auth::user()):

            $role = Auth::user();

            if ($role->user_role == 'User'):

                return response()->view('adminpanel.layouts.permission');

            endif;

        endif;


        return $next($request);
    }
}
