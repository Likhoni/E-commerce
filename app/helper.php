<?php

use App\Models\Permission;
use App\Models\Role_permission;
use Illuminate\Support\Facades\Auth;

function checkPermission($routeName)
{

    // $thisUserRole = auth()->user()->role_id;

    // $getPermission = Permission::where('slug', $routeName)->first();

    // $checkHasPermission = Role_permission::where('role_id', $thisUserRole)
    //     ->where('permission_id', $getPermission->id)->first();

    // if ($checkHasPermission) {
    //     return true;
    // }

    // return false;
    if (Auth::user()->role->name == 'Super Admin') {
        return true;
    }

    $thisUserRole = Auth::user()->role_id;
    $getPermission = Permission::where('slug', $routeName)->first();
    $checkHasPermission = Role_permission::where('role_id', $thisUserRole)
        ->where('permission_id', $getPermission->id)->first();

    if ($checkHasPermission) {
        return true;
    }

    return false;
}
