<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * @description used to user is authenticated or not. If not then redirect to login page.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 04.07.21
     * @version v1
     * @param 
     * @return view
     */
    protected function redirectTo($request)
    {
        return Auth::check() ? route('dashboard') : route('auth.login-page');
    }
}
