<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Throwable;

class UserController extends Controller
{  
    //form 
    public function adminLogin()
    {
        return view('backend.pages.adminLogin');
    }

    //do-login
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

    //logout
    public function adminLogout()
    {
        Auth::logout(); //(works in laravel 11)
        // auth()->logout();(works in laravel 10)

        notify()->success("Sign Out Successful.");
        return redirect()->route('login');
    }

    //list
    public function userList()
    {
        $user = User::with('role')->get();
        return view('backend.pages.user.userList', compact('user'));
    }

    //create
    public function userForm()
    {
        $role = Role::all();
        return view('backend.pages.user.userForm',compact('role'));
    }

    //store
    public function SubmitUserForm(Request $request)
    {
        //Validation
        $checkValidation = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'role_id' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'password' => 'required',
             
        ]);
        
        if ($checkValidation->fails()) {
            // notify()->error($checkValidation->getMessageBag());
            notify()->error("Something Went Wrong");
            return redirect()->back();
        }

         //Store Data
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role_id' => $request->role_id,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_number' => $request->phone_number,
            'image' => $request->user_image,
            'address' => $request->address,
        ]);
        notify()->success("User Created Successfully.");
        return redirect()->back();
    }

    //Edit
    public function userEdit($id)
    {
        $editUser = User::find($id);
        return view('backend.pages.user.editUser', compact('editUser'));
    }

    //Update
    public function userUpdate(Request $request, $id)
    {
        $updateUser = User::find($id);
        $checkValidation = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            // 'user_image' => 'required'
            'address' => 'required'
        ]);
        if ($checkValidation->fails()) {
            // notify()->error($checkValidation->getMessageBag());
            notify()->error("Something Went Wrong");
            return redirect()->back();
        }

        $updateUser->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'image' => $request->user_image,
            'address' => $request->address
        ]);
        notify()->success("User Updated Successfully.");
        return redirect()->route('user.list');
    }

    //delete
    public function userDelete($id)
    {
        try{

            $deleteUser = User::find($id);
            $deleteUser->delete();
            
            notify()->success('User Deleted Successfully.');
            return redirect()->back();
        }catch (Throwable $ex) {

            notify()->error("This User Has Order, You Cannot Delete It");
            return redirect()->back();
        } 
    }
}
