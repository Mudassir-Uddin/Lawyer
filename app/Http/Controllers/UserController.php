<?php

namespace App\Http\Controllers;

use App\Models\Lawyer;
use App\Models\users;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //______________ Dashboard User ______________________
    function index()
    {
        $service = users::all();
        return view('dashboard.User_index', compact('service'));
    }


    //____________ Insert ________________
    #region Insert 

    
    function insert()
    {
        return view('dashboard.Users_insert');
    }

    function Store(Request $req)
    {
        $req->validate([
            'name' => 'required | max:50 | min:3',
            'img' => 'required | image | mimes:png,jpg'
        ]);

        $img = $req->img;
        $imgname = $img->getClientOriginalName();
        $imgname = time() . "__" . $imgname;
        $img->move("images/Usersimages/", $imgname);

        $st = new users;
        $st->name = $req->name;
        $st->img = "images/Usersimages/$imgname";
        $st->save();

        return redirect('dashboard/User_index');

    }

    #endregion


    //____________ Update ________________
    #region Insert
    function edit($id)
    {
        $user = User::Where('user_id', $id)->first();
        $role = Session::get('role');
        if ($user) {
            if ($user->role = 3) { //lower 
                $lawyer = Lawyer::where("userid", $user->user_id)->first();
                return view('dashboard.Users_edit', compact('user', 'role', 'id', 'lawyer'));
            } else {
                return view('dashboard.Users_edit', compact('user', 'role', 'id'));
            }
        }
    }

    function update(Request $req, $id)
    {
        $user = users::find($id);
        
        $imgname = $user->img;
        if ($req->hasfile('img')) {
            
            $img = $req->img;
            $imgname = $img->getClientOriginalName();
            $imgname = time() . "__" . $imgname;
            $img->move("images/Usersimages/", $imgname);
            $imgname = "/images/Usersimages/".$imgname;
            if($user->img){
                if(file_exists(public_path($user->img))){
                    unlink(public_path($user->img));
                }
            }
            // unlink($req->oldimg);
        }

        if ($user) {
            $user->user_name = $req->name;
            $user->address = $req->address;
            $user->img = $imgname;
            $user->save();

            if ($user->role == 3) {
                $lawyer = lawyer::where('userId', $user->user_id)->first();
                // dd($lawyer);
                $lawyer->satisfaction = $req->satisfaction;
                $lawyer->update();
            }
            return redirect('/dashboard/User_index');
        }
    }
    #endregion 
    

    //____________ Delete ___________
    function delete($user_id)
    {
        $st = users::find($user_id);
        if ($st) {
            if($st->img){
                if(file_exists(public_path($st->img))){
                    unlink(public_path($st->img));
                }
            }
            $st->delete();
            return redirect('/dashboard/User_index');
        }
        return redirect('/dashboard/User_index');
    }

    //____________ Sorting ___________
    public function sorting ($id){
        if($id == 1){
            $service = users::WhereIn('role',[ 2])->get();
            return view('dashboard.User_index', compact('service'));
        }
        if($id == 3){
            $service = users::WhereIn('role',[3])->get();
            return view('dashboard.User_index', compact('service'));
        }
        $service = users::all();
        return view('dashboard.User_index', compact('service'));
    }

}