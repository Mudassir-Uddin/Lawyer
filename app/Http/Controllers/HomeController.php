<?php

namespace App\Http\Controllers;


use App\Models\Lawyer;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    function index(){
        return view('website.Home');
    }
    
    function Home(){
        return view('website.Home');

    }
    function about(){
        return view('website.about');

    }
    function blog(){
        return view('website.blog');

    }
    function contact(){
        return view('website.contact');
    }
    function lawyers(){
        
        $users = DB::select('select * from users u inner join lawyere l on l.userid = u.user_id where role = ? and l.satisfaction = 1 ', [3]);
        // dd($users);
        return view('website.lawyers',compact('users'));

    }

    function lawyer_details($id){
        $users = DB::select('select * from users u inner join lawyere l on l.userid = u.user_id where role = ? and user_id = ? and l.satisfaction = 1 ', [3,$id]);
        
        // dd($users);
        return view('website.lawyer_details',compact('users'));

    }
    // function lawyer_edit(){
    //     // $users = DB::select('select * from users u inner join lawyere l on l.userid = u.user_id where role = ? and user_id = ? and l.satisfaction = 1 ', [3,$id]);
        
    //     // dd($users);
    //     return view('website.lawyer_edit');

    // }
    function services(){
        // $users = DB::select('select * from users u inner join lawyere l on l.userid = u.user_id where role = ? and user_id = ? and l.satisfaction = 1 ', [3,$id]);
        
        // dd($users);
        return view('website.services');

    }


    function single(){
        return view('website.single');

    }
}
    