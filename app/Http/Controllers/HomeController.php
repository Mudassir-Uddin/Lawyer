<?php

namespace App\Http\Controllers;


use App\Http\Middleware\Appoinment;
use App\Models\Appointment;
use App\Models\Lawyer;
use App\Models\users;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class HomeController extends Controller
{
    function index()
    {
        return view('website.Home');
    }

    function Home()
    {
        return view('website.Home');

    }

    function about()
    {
        return view('website.about');

    }
    function blog()
    {
        return view('website.blog');

    }

    function contact()
    {
        return view('website.contact');
    }
    function lawyers()
    {

        $users = DB::select('select * from users u inner join lawyere l on l.userid = u.user_id where role = ? and l.satisfaction = 1 ', [3]);
        // dd($users);
        return view('website.lawyers', compact('users'));

    }

    function lawyer_details($id)
    {
        $users = DB::select('select * from users u inner join lawyere l on l.userid = u.user_id where role = ? and user_id = ? and l.satisfaction = 1 ', [3, $id]);
        // dd($users);
        // dd($users);
        return view('website.lawyer_details', compact('users'));

    }

    function services()
    {
        $service = DB::select('select * from services');

        // dd($users);
        return view('website.services', compact('service'));

    }


    function single()
    {
        return view('website.single');

    }

    function edit()
    {
        $id = Session::get('id');
        $user = users::Where('user_id', $id)->first();
        $role = Session::get('role');
        if ($user) {
            return view('website.Profile_edit', compact('user', 'role', 'id'));
        }
    }


    function editPost(Request $req, $id)
    {
        // dd($id);
        $user = users::findOrFail($id);

        $user->user_name = $req->username;
        $user->address = $req->address;
        // dd($user->address);

        //______ image Upload ____________
        $imgname = $user->img;
        if ($req->hasfile('image')) {
            
            $img = $req->image;
            $imgname = $img->getClientOriginalName();
            $imgname = time() . "__" . $imgname;
            $img->move("images/Usersimages/", $imgname);
            $imgname = "/images/Usersimages/" . $imgname;
            // unlink($req->oldimg);
            if($user->img){
                if(file_exists(public_path($user->img))){
                    unlink(public_path($user->img));
                }
            }
        }
        //__________________________
        $user->img = $imgname;
        // dd($user);
        $user->save();
        return redirect('/');
    }

    //______________________ Lawyer Working _____________
    //__ List _____

    //______________________ Place Appointment  ______________
    function Appoinment($id)
    {
        $lawyerId = $id; 
        return view('website.Appoinment', compact('lawyerId'));
    }

    public function AppointmentPost($lawyerId, Request $req)
    {
        $req->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'PlaceMeeting' => 'required|string|max:255',
            'meeting_date' => 'required|date|after:tomorrow',
        ]);

        $CurrentUserId = Session::get("id");

        $appo = new Appointment();
        $appo->user_id = $CurrentUserId;
        $appo->lawyer_id = $lawyerId;
        $appo->meeting_date = $req->meeting_date;
        $appo->place = $req->PlaceMeeting;
        $appo->name = $req->name;
        $appo->email = $req->email;
        $appo->address = $req->address;
        $appo->status = 1;
        //___ booking status ____
        //1 = Pending  ---> on  1st added  default 1 ;     Lawyer will chenge status of  Booking
        //2 = Done
        //3 = Finished
        //4 = canceled
        //5 = Rejected
        $appo->booking_status = 1; 
        $appo->save();

        return redirect('/Appoinment_Details');
    }

    //______________________ List Appointment  ______________
    //___ User ___
    //user can delete  apointment if the   has default  status ---->  Pending.    else  Removed button invisible ho gaa
    //user   (user can see   list but  ---> only can see  lawyer image ,  apointment detail , status. )

    //___ Lawyer __
    //lawyer (lawyer can see  All users appoin  ,  name, images,...  )
    function Appoinment_Details()
    {
        $CurrentUserId = Session::get("id");
        $user = users::find($CurrentUserId);
        $role = $user->role;

        if($role == 3){
            $appoin = Appointment::where('lawyer_id',$user->user_id)->get();
            
            // dd($appoin);
            return view('website.Appoinment_Details',compact('appoin','role'));
        }
        if($role == 2){
            $appoin = Appointment::where('user_id',$user->user_id)->get();
            // dd($appoin);
            return view('website.Appoinment_Details',compact('appoin','role'));
        }

        return redirect('/');
    }


    function Appoinment_Confirm(Request $req,$id)
    {
        // dd($req->confirmValue , $id);
        $appoint = Appointment::find($id);
        $appoint->booking_status = $req->confirmValue;
        $appoint->save();
        return redirect('/Appoinment_Details');
    }





}