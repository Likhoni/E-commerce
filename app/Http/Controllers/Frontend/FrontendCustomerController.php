<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class FrontendCustomerController extends Controller
{
    public function frontendSignUp()
    {
        return view('frontend.pages.signup');
    }

    public function frontendDoSignup(Request $request)
    {
        //Validation
        $checkValidation = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
            // 'phone_number' => 'required',
            // 'customer_image' => 'required'
            // 'address' => 'required'
        ]);
        if ($checkValidation->fails()) {
            notify()->error($checkValidation->getMessageBag());
            return redirect()->back();
        }

        $image = '';
        if ($request->hasFile('image')) {
            $image = date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/customers', $image);
        }

        //Otp
        $otp=rand(100000,999999);

        Customer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_number' => $request->phone_number,
            'image' => $image,
            'address' => $request->address,
            'otp'=>$otp,
            'otp_expired_at'=>now()->addMinutes(3)
        ]);

        $email = $request->email;
        Mail::to($email)->send(new SendMail($otp));
        notify()->success("Registration Successful");
        return view('frontend.pages.customer.otp',compact('email'));
    }

    public function frontendSignIn()
    {
        return view('frontend.pages.signin');
    }

    public function frontendDoSignIn(Request $request)
    {
        //Validation
        $checkValidation = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        $customerInput = $request->except('_token');
        // $customerInput = 
        // [
        //     'email' => $request->email,
        //     'password' => $request->password
        // ];

        $checkLogin = auth()->guard('customerGuard')->attempt($customerInput);

        // if ($checkValidation->fails()) {
        //     notify()->error("Invalid Credentials.");
        //     return redirect()->back();
        // }
        if ($checkLogin) {
            $customer = auth('customerGuard')->user();
            
            if ($customer->is_email_verified == true) {
                
                notify()->success("Sign-In Successful.");
                return redirect()->route('frontend.homepage');
            } else {
                auth('customerGuard')->logout();
                notify()->error('Account Not Verified,Use OTP to Verify Your Account');
                $email = $customer->email;
                return view('frontend.pages.customer.otp',compact('email'));
            }
        } else {
            notify()->error("Invalid Credentials.");
            return redirect()->back();
        }
    }

    public function frontendSignOut()
    {
        auth('customerGuard')->logout();
        notify()->success("Sign-Out Successful.");
        return redirect()->route('frontend.homepage');
    }

    //View Customer profile
    public function customerView()
    {
        $viewCustomer = Customer::find(auth('customerGuard')->user()->id);
        // dd($viewCustomer);
        return view('frontend.pages.customer.viewCustomer', compact('viewCustomer'));
    }

    //Edit Customer Profile
    public function customerEdit()
    {
        $editCustomer = Customer::find(auth('customerGuard')->user()->id);
        return view('frontend.pages.customer.editCustomer', compact('editCustomer'));
    }

    //Update
    public function customerUpdate(Request $request)
    {

        $updateCustomer = Customer::find(auth('customerGuard')->user()->id);
        $checkValidation = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            //'phone_number' => 'required',
            // 'image' => 'required'
            'address' => 'required'
        ]);
        if ($checkValidation->fails()) {
            // notify()->error($checkValidation->getMessageBag());
            notify()->error("Something Went Wrong");
            return redirect()->back();
        }

        $image = $updateCustomer->image;

        if ($request->hasFile('image')) {

            $image = date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->storeAs('/customers', $image);
            File::delete('images/customers/' . $updateCustomer->image);
        }


        $updateCustomer->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'image' => $image,
            'address' => $request->address
        ]);
        notify()->success("Profile Updated successfully.");
        return redirect()->route('customer.view');
    }

    //OTP-One Time Password
    public function otpPage()
    {
        return view('frontend.pages.customer.otp');
    }

    public function otpSubmit(Request $request){
        $user = Customer::where('email', $request->email)
                         ->where('otp', $request->otp)->first();
        $email=$request->email;

        if($user)
        {
            if(strtotime($user->otp_expired_at) > strtotime(now()))
            {
                //Verified at
                $user->update([
                    'is_email_verified'=>true,
                    'otp'=>null,
                    'otp_expired_at'=>null
                ]);
                notify()->success('Account Verified.');
                return redirect()->route('frontend.homepage');
            }else{
                notify()->error('Otp Expired, Please re-send OTP');
                return view('frontend.pages.customer.otp',compact('email'));
            }

        }else{
            //Incorrect otp or email
            notify()->error('Invalid OTP or Email.');
            return view('frontend.pages.customer.otp',compact('email'));
        }
        
    }

    //Re-Send OTP
    public function otpResend($email){

        $user = Customer::where('email', $email)->first();

        if($user)
        {
            $otp= rand(100000, 999999);
            $user->update([
                'otp'=>$otp,
                'otp_expired_at'=>now()->addMinutes(3),
            ]);
            notify()->success('Re-Send Success');
            return view('frontend.pages.customer.otp',compact('email'));
        }
    }
}
