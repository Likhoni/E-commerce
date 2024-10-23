<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Group; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Throwable;
 
class GroupController extends Controller
{
    //list
    public function groupList()
    {
        $group = Group::with('parentGroup')->get();
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
        // dd(request()->all());
        //Validation
        $checkValidation = Validator::make($request->all(), [
            'group_name' => 'required',
            // 'image' => 'required',
            //'status' => 'required',
        ]);
        if ($checkValidation->fails()) {
            //notify()->error($checkValidation->getMessageBag());
            notify()->error("Something Went Wrong");
            return redirect()->back();
        }

        $group_image= '';
        if($request->hasFile('group_image'))
        {
            $group_image = date('YmdHis') . '.' . $request->file('group_image')->getClientOriginalExtension();
            $request->file('group_image')->storeAs('/groups', $group_image);
        }

        //Store Data
        Group::create([
            'group_name' => $request->group_name,
            'group_image' => $group_image,
            'discount' => $request->discount,
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

        $group_image = $updateGroup->group_image;

        if ($request->hasFile('group_image')) {

            $group_image = date('YmdHis') . '.' . $request->file('group_image')->getClientOriginalExtension();

            $request->file('group_image')->storeAs('/groups', $group_image);
            File::delete('images/groups/' . $updateGroup->group_image);
        }

        $updateGroup->update([
            'group_name' => $request->group_name,
            'group_image' => $group_image,
            'discount' => $request->discount,
            'status' => $request->status
        ]);
        notify()->success("Group Updated Successfully.");
        return redirect()->route('group.list');
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
