<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class GroupController extends Controller
{
    //list
    public function groupList()
    {
        $group = Group::all();
        return view('backend.pages.group.groupList', compact('group'));
    }

    //create
    public function groupForm()
    {
        $groups = Group::all();
        return view('backend.pages.group.groupForm', compact('groups'));
    }

    //store 
    public function submitGroupForm(Request $request)
    {
        //Validation
        $checkValidation = Validator::make($request->all(), [
            'group_name' => 'required',
            // 'category_image' => 'required',
            //'status' => 'required',
        ]);
        if ($checkValidation->fails()) {
            //notify()->error($checkValidation->getMessageBag());
            notify()->error("Something Went Wrong");
            return redirect()->back();
        }

        //Store Data
        Group::create([
            'group_name' => $request->group_name,
            'group_image' => $request->group_image,
            'status' => $request->status
        ]);
        notify()->success("Group Created Successfully.");
        return redirect()->back();
    }

    // Edit
    public function groupEdit($id)
    {
        $editGroup = Group::find($id);
        return view('backend.pages.group.editGroup', compact('editGroup'));
    }
    
    //Update 
    public function groupUpadte(Request $request, $id)
    {
        $updateGroup = Group::find($id);
        $checkValidation = Validator::make($request->all(), [
           'group_name' => 'required',
            // 'category_image' => 'required',
            //'status' => 'required',
        ]);
        if ($checkValidation->fails()) {
            // notify()->error($checkValidation->getMessageBag());
            notify()->error("Something Went Wrong");
            return redirect()->back();
        }
        $updateGroup->update([
            'group_name' => $request->group_name,
            'group_image' => $request->group_image,
            'status' => $request->status
        ]);
        notify()->success("Group Updated Successfully.");
        return redirect()->route('admin.group.list');
    }

    //Delete
    public function groupDelete($id)
    {
        try {

            $deleteGroup = Group::find($id);
            $deleteGroup->delete();

            notify()->success("Group Deleted Successfully.");
            return redirect()->back();
        } catch (Throwable $ex) {

            notify()->error("This Group Has Category Or Product, You Cannot Delete It");
            return redirect()->back();
        } 
    }
}
