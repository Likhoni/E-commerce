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

    //Edit
    public function roleEdit($id)
    {
        $editRole = Role::find($id);
        return view('backend.pages.role.editRole', compact('editRole'));
    }

    public function roleUpdate(Request $request, $id)
    {

        $checkValidation = Validator::make($request->all(), [
           'name' => 'required',
            // 'status' => 'required',
        ]);
        if ($checkValidation->fails()) {
            notify()->error($checkValidation->getMessageBag());
            return redirect()->back();
        }

        $updateRole = Role::find($id);
        $updateRole->update([
            'name' => $request->name,
            'status' => $request->status
        ]);
        notify()->success("Role Updated successfully.");
        return redirect()->route('admin.role.list');
    }

    public function roleDelete($id)
    {
        $deleteRole = Role::find($id);
        $deleteRole->delete();

        notify()->success('Role Deleted Successfully.');
        return redirect()->back();
    }


    //Assign Permission
    public function asssignPermission($id)
    {
        $roles= Role::find($id);
        return view('backend.pages.role.permission', compact('roles'));
    }
}
