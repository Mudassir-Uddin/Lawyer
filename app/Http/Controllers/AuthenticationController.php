<?php

namespace App\Http\Controllers;

use App\Models\Lawyer;
use App\Models\User;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

class AuthenticationController extends Controller
{

    //_____________________ Registration _____________________
    function register()
    {
        return view('website.register');
    }
    function registerstore(Request $req)
    {
        $req->validate([
            'name' => 'required | max:50 | min:3',
            'email' => 'required | max:40',
            'pass' => 'required | max:25',
            'document' => $req->checks == 1 ? 'required' :  ''
        ]);

        if ($req->checks == 1) {
            $user = new users;
            $user->user_name = $req->name;
            $user->email = $req->email;
            $user->role = 3;
            $user->password = Hash::make($req->pass);
            $user->address = $req->address;
            $user->save();

            $lastUserId = $user->user_id;

            //__ document upload by Mudasir ______
            $document = "no document";
            if ($req->document) {
                $file = $req->document;
                $doc = $file->getClientOriginalName();
                $doc = time() . "_" . $doc;
                $file->move("document/", $doc);
                $document = "/document/" . $doc;
            }

            if ($lastUserId != null) {
                $lawyer = new Lawyer;
                $lawyer->userid = $lastUserId;
                $lawyer->document = $document;
                $lawyer->satisfaction = false;
                $lawyer->Save();

                Session::put('lawyerMessage' , "Your Request Has been seent to Admin Please Wait for 1 Hours",);
            }
        } else {
            $user = new users;
            $user->user_name = $req->name;
            $user->email = $req->email;
            $user->role = 2;
            $user->password = Hash::make($req->pass);
            $user->address = $req->address;
            $user->save();

            session()->put([
                'id' => $user->user_id,
                'name' => $user->user_name,
                'email' => $user->email,
                'role' => $user->role,
            ]);
        }
        
        return redirect('/');
    }

    //_____________________ Login _____________________
    function login()
    {
        return view('website.login');
    }
    function loginstore(Request $req)
    {
        $req->validate([
            'email' => 'required | max:40',
            'pass' => 'required',
        ]);

        $user = users::where('email', $req->email)
            ->where('status', 1)
            ->first();

        if (!$user || !Hash::check($req->pass, $user->password)) {
            return new JsonResponse(['message' => 'Invalid credentials'], 401);
        }

        if ($user->role == 1) {
            session()->put([
                'id' => $user->user_id,
                'name' => $user->user_name,
                'email' => $user->email,
                'role' => $user->role,
            ]);
            return new JsonResponse(['message' => 'Login successful', 'redirect' => '/dashboard/Admindashboard'], 200);

        } elseif ($user->role == 2) {
            session()->put([
                'id' => $user->user_id,
                'name' => $user->user_name,
                'email' => $user->email,
                'role' => $user->role,
            ]);
            // return redirect('/dashboard/Admindashboard');
            return new JsonResponse(['message' => 'Login successful', 'redirect' => '/'], 200);
        } elseif ($user->role == 3) {
            $lawyer = Lawyer::where('userId', $user->user_id)->first();
            if ($lawyer) {
                if ($lawyer->satisfaction == true) {
                    session()->put([
                        'id' => $user->user_id,
                        'name' => $user->user_name,
                        'email' => $user->email,
                        'role' => $user->role,
                        'lawyer' => 'true'
                    ]);
                    return new JsonResponse(['message' => 'Login successful', 'redirect' => '/'], 200);
                } else {
                    return new JsonResponse(['message' => 'Lawyer not authorized'], 403);
                }
            }
        }
        return redirect('/login');
    }

    function logout()
    {
        session()->forget('id');
        session()->forget('name');
        session()->forget('email');
        session()->forget('role');

        return redirect('/login');
    }

}