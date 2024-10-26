<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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
        $authUser = Auth::user();
        if($authUser->role->name=='Super Admin'){
            $user = User::with('role')->get();
        }
        else{
            $user = User::with('role')->where('id', $authUser->id)->get();
        }
        return view('backend.pages.user.userList', compact('user'));
    }

    //create
    public function userForm()
    {
        $role = Role::all();
        return view('backend.pages.user.userForm', compact('role'));
    }

    //store
    public function SubmitUserForm(Request $request)
    {
        // dd(request()->all());
        //Validation
        $checkValidation = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'role_id' => 'required',
            'email' => 'required',
            'password' => 'required',
            //'phone_number' => 'required',
            //'image' => 'required',
            //'address' => 'required',

        ]);

        if ($checkValidation->fails()) {
            // notify()->error($checkValidation->getMessageBag());
            notify()->error("Something Went Wrong");
            return redirect()->back();
        }

        $image = '';
        if ($request->hasFile('image')) {
            $image = date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/users', $image);
        }

        //Store Data
        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role_id' => $request->role_id,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_number' => $request->phone_number,
            'image' => $image,
            'address' => $request->address,
        ]);
        notify()->success("User Created Successfully.");
        return redirect()->back();
    }

    //Edit
    public function userEdit($id)
    {
        $role = Role::all();
        $editUser = User::find($id);
        return view('backend.pages.user.editUser', compact('editUser', 'role'));
    }

    //Update
    public function userUpdate(Request $request, $id)
    {
        $updateUser = User::find($id);
        $checkValidation = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'role_id' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            // 'image' => 'required',
            //'address' => 'required'
        ]);
        if ($checkValidation->fails()) {
            notify()->error($checkValidation->getMessageBag());
            // notify()->error("Something Went Wrong");
            return redirect()->back();
        }

        $image = $updateUser->image;
        if ($request->hasFile('image')) {
            $image = date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/users', $image);
            File::delete('images/users/' . $updateUser->image);
        }

        $updateUser->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'role_id' => $request->role_id,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'image' => $image,
            'address' => $request->address,
        ]);
        notify()->success("User Updated Successfully.");
        return redirect()->route('user.list');
    }

    //delete
    public function userDelete($id)
    {
        try {

            $deleteUser = User::find($id);
            $deleteUser->delete();

            notify()->success('User Deleted Successfully.');
            return redirect()->back();
        } catch (Throwable $ex) {

            notify()->error("This User Has Order, You Cannot Delete It");
            return redirect()->back();
        }
    }
}
