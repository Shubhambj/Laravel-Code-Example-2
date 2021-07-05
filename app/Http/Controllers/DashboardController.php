<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    /**
     * @description used to load dashboard.
     * @author Shubham Bhardwaj <shubham.bj@gmail.com>
     * @created on 04.07.21
     * @version v1
     * @param 
     * @return view
     */
    public function index() {
        return response()->view('dashboard');
    }
}
