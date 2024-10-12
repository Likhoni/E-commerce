<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Role_permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class RoleController extends Controller
{
    //list
    public function roleList()
    {
        $role = Role::all();
        return view('backend.pages.role.roleList', compact('role'));
    }

    //create
    public function roleForm()
    {
        return view('backend.pages.role.roleForm');
    }

    //store
    public function SubmitRoleForm(Request $request)
    {
        //Validation
        $checkValidation = Validator::make($request->all(), [
            'name' => 'required',
            // 'status' => 'required',

        ]);

        if ($checkValidation->fails()) {
            // notify()->error($checkValidation->getMessageBag());
            notify()->error("Something Went Wrong");
            return redirect()->back();
        }

        //Store Data
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

    //Update
    public function roleUpdate(Request $request, $id)
    {

        $updateRole = Role::find($id);
        $checkValidation = Validator::make($request->all(), [
            'name' => 'required',
            // 'status' => 'required',
        ]);
        if ($checkValidation->fails()) {
            // notify()->error($checkValidation->getMessageBag());
            notify()->error("Something Went Wrong");
            return redirect()->back();
        }

        $updateRole->update([
            'name' => $request->name,
            'status' => $request->status
        ]);
        notify()->success("Role Updated successfully.");
        return redirect()->route('admin.role.list');
    }

    //Delete
    public function roleDelete($id)
    {
        try {

            $deleteRole = Role::find($id);
            $deleteRole->delete();

            notify()->success('Role Deleted Successfully.');
            return redirect()->back();
        } catch (Throwable $ex) {

            notify()->error("This Role Has User, You Cannot Delete It");
            return redirect()->back();
        }
    }

    //Assign Permission
    public function asssignPermission($id)
    {
        $permissions = Permission::all();
        $roles = Role::findOrFail($id);
        return view('backend.pages.role.permission', compact('roles', 'permissions'));
    }

    //store role permission
    public function storePermission(Request $request)
    {
        $checkValidation = Validator::make($request->all(), [
            'role_id' => 'required',
            'permission_id' => 'required|array',
        ]);

        if ($checkValidation->fails()) {
            notify()->error("Something Went Wrong.");
            // notify()->error($checkValidation->getMessageBag());
            return redirect()->back();
        }
        //dd($request->all());
        foreach ($request->permission_id as $permissionId) {
            Role_permission::create([
                'role_id' => $request->role_id,
                'permission_id' => $permissionId,
                //'permission_id' => $request->permission_id,
            ]);
        }

       //$role_permission->permission()->attach($request->permission_id);

        notify()->success('Role Permissions Set Successfully.');
        return redirect()->back();
    }
}
