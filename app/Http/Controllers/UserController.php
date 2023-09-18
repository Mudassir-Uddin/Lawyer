<?php

namespace App\Http\Controllers;

use App\Models\users;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    function index(){
        $service = users::all();

        return view('dashboard.User_index',compact('service'));
    }
    function insert(){

        return view('dashboard.Users_insert');
    }

    function Store(Request $req){

    $req->validate([
        'name' => 'required | max:50 | min:3',
        'img' => 'required | image | mimes:png,jpg'
        
    ]);

    $img = $req->img;
    $imgname = $img->getClientOriginalName();
    $imgname = time() . "__" . $imgname;
    $img->move("images/Serviceimages/",$imgname);

    $st = new users;
    $st->name = $req->name;
    $st->img = "images/Serviceimages/$imgname";
    $st->save();

    return redirect('dashboard/Services_index');

    }
    function edit(){
        $id = Session::get('id');
        $user = User::Where('user_id',$id)->get();
        if($user){
            return view('website.Profile_edit', compact('user'));
        }
    }
    function update(Request $req,$id){
        $st = users::find($id);

        if($req->img){
            $img = $req->img;
            $imgname = $img->getClientOriginalName();
            $imgname = time() . "__" . $imgname;
            $img->move("images/Serviceimages/",$imgname);
            // unlink($req->oldimg);
        }
        else{
            $imgname = $req->oldimg;
        }

        if($st){
             $st->name = $req->name;
             $st->img = $imgname;

             $st->save();

             return redirect('/dashboard/User_index');
        }
    }

    function delete($id){
        $st = users::find($id); 

        if($st){
            $st->delete();
            return redirect('/dashboard/User_index');
        }
            return redirect('/dashboard/User_index');
    }

}
