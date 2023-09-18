<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\users;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
    function dashboard()
    {
        return view('dashboard.Admindashboard');
    }


    function lawyer()
    {
        return view('dashboard.Service_index');
    }
    function service()
    {
        return view('dashboard.Service_index');
    }
    function users()
    {
        return view('dashboard.Users_index');
    }

    // Service

    function index()
    {
        $service = Service::all();

        return view('dashboard.Services_index', compact('service'));
    }
    function insert()
    {

        return view('dashboard.Service_insert');
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
        $img->move("images/Serviceimages/", $imgname);

        $st = new Service;
        $st->name = $req->name;
        $st->img = "images/Serviceimages/$imgname";
        $st->save();

        return redirect('dashboard/Services_index');

    }
    function edit($id)
    {
        $st = Service::find($id);
        if ($st) {
            return view('dashboard.Service_edit', compact('st'));
        }
        return redirect('/dashboard/Services_index');

    }
    function update(Request $req, $id)
    {
        
        $st = Service::find($id);

        if ($req->img) {
            $img = $req->img;
            $imgname = $img->getClientOriginalName();
            $imgname = time() . "__" . $imgname;
            $img->move("images/Serviceimages/", $imgname);
            // unlink($req->oldimg);
        } 
        else {
            $imgname = $req->oldimg;
        }

        if ($st) {
            $st->name = $req->name;
            $st->img = $imgname;

            $st->save();

            return redirect('/dashboard/Services_index');
        }
    }

    function delete($id)
    {
        $st = Service::find($id);

        if ($st) {
            if($st->img){
                if(file_exists(public_path($st->img))){
                    unlink(public_path($st->img));
                }
            }
            $st->delete();
            return redirect('/dashboard/Services_index');
        }
        return redirect('/dashboard/Services_index');
    }

    // Lawyer 

    public function Lawyerindex(){
        
        $Lawyers = users::all();
        return view('dashboard.Lawyers_index', compact('Lawyers'));
    }
    public function sorting ($id){
        if($id == 1){
            $Lawyers = users::WhereIn('role',[1,2])->get();
            return view('dashboard.Lawyers_index', compact('Lawyers'));
        }
        if($id == 3){
            $Lawyers = users::WhereIn('role',[3])->get();
            return view('dashboard.Lawyers_index', compact('Lawyers'));
        }
        $Lawyers = users::all();
        return view('dashboard.Lawyers_index', compact('Lawyers'));
    }

}