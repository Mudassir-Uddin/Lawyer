<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
    function dashboard(){
        return view('dashboard.Admindashboard');
    }
    function lawyer(){
        return view('dashboard.Service_index');
    }
    function service(){
        return view('dashboard.Service_index');
    }
    function users(){
        return view('dashboard.Users_index');
    }

}
