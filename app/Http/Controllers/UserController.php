<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function adminLogin()
    {
        return view('backend.pages.adminLogin');
    }

    public function adminDoLogin(Request $request)
    {

        $userLogin = $request->except('_token');

        // $checkLogin=auth()->attempt($userLogin);(work in Laravel 10)

        $checkLogin = Auth::attempt($userLogin); //work in Laravel 11

        if ($checkLogin) {
            notify()->success("Sign In Successful.");
            return redirect()->route('homepage');
        }

        notify()->error('Invalid Credentials.');
        return redirect()->back();
    }

    public function adminLogout()
    {

        // auth()->logout();(works in laravel 10)

        Auth::logout(); //(works in laravel 11)
        // notify()->success("Sign-Out Successful.");
        return redirect()->route('admin.login');

    }
}
