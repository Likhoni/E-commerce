<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //backend
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


    //frontend
    public function frontendSignUp()
    {
        return view('frontend.pages.signup');
    }

    public function frontendDoSignup(Request $request){
        //Validation
        $checkValidation = Validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            // 'customer_image' => 'required'
            'address' => 'required'
        ]);
        if ($checkValidation->fails()) {
            notify()->error($checkValidation->getMessageBag());
            return redirect()->back();
        }

         Customer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'image' => $request->customer_image,
            'address' => $request->address
        ]);
        notify()->success("Registration Successful");
        return redirect()->route('frontend.homepage');
    }

    public function frontendSignIn()
    {
        return view('frontend.pages.signin');
    }

    

}
