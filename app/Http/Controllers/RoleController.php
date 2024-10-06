<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function roleList()
    {
        $role = Role::all();
        return view('backend.pages.role.roleList', compact('role'));
    }

    public function roleForm()
    {
        return view('backend.pages.role.roleForm');
    }

    public function SubmitRoleForm(Request $request)
    {
        //Validation
        // dd($request->all());
        $checkValidation = Validator::make($request->all(), [
            'name' => 'required',
            // 'status' => 'required',
             
        ]);
        
        if ($checkValidation->fails()) {
            notify()->error($checkValidation->getMessageBag());
            return redirect()->back();
        }

        Role::create([
            'name' => $request->name,
            'status' => $request->status
        ]);
        notify()->success("Role Created successfully.");
        return redirect()->back();
    }


    //Assign Permission
    public function asssignPermission($id)
    {
        $roles= Role::find($id);
        return view('backend.pages.role.permission', compact('roles'));
    }
}
