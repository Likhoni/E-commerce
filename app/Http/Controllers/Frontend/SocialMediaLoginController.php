<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialMediaLoginController extends Controller
{
    public function socialLogin($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    public function callback()
    {
        $user = Socialite::driver('github')->user();

        //find the user in customer table
        $customer = Customer::where('provider_id', $user->id)->first();

        if ($customer)
        {
            //Do the log in
            Auth::guard('customerGuard')->login($customer, true);
            notify()->success('Login successfull.');
        } 
        else
        {
            //registar first
            $customer = Customer::create([
                'first_name'=>$user->name,
                'last_name' => $user->name,
                'email' => strtolower($user->nickname) . '@gmail.com',
                'phone_number' => '01709000000',
                'image' => $user->avatar,
                'provider_id' => $user->id,
                'password' => bcrypt('123456'),
                'address' => $user->location,
            ]);
            //then login
            Auth::guard('customerGuard')->login($customer, true);
            notify()->success('Register and Login successfull.');
        }
        return redirect()->route('frontend.homepage');
    }
}
