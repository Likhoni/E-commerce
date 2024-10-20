<?php

use App\Models\Permission;
use App\Models\Role_permission;


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
    if (auth()->user()->role->name == 'Super Admin') {
        return true;
    }

    $thisUserRole = auth()->user()->role_id;
    $getPermission = Permission::where('slug', $routeName)->first();
    $checkHasPermission = Role_permission::where('role_id', $thisUserRole)
        ->where('permission_id', $getPermission->id)->first();

    if ($checkHasPermission) {
        return true;
    }

    return false;
}
