<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class GroupController extends Controller
{
    //list
    public function groupList()
    {
        $group = Group::with('parentGroup')->get();
        return view('backend.pages.group.groupList', compact('group'));
    }

    public function ajaxDataTable()
    {

        $data = Group::with('parentGroup')->select('groups.*');

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('parent_group', function ($row) {
                return $row->parentGroup ? $row->parentGroup->group_name : 'N/A';
            })
            ->addColumn('group_image', function ($row) {
                if ($row->group_image) {
                    return '<img src="' . asset('images/groups/' . $row->group_image) . '" width="100" height="100" />';
                }
                return '<img src="' . asset('images/default.avif') . '" width="100" height="100" />';
            })

            ->addColumn('action', function ($row) {

                $editUrl = route('group.edit', $row->id);
                $deleteUrl = route('group.delete', $row->id);

                return '<a href="' . $editUrl . '" class="view btn btn-primary btn-sm">Edit</a>
                <a href="javascript:void(0)" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
            })
            ->rawColumns(['group_image', 'action'])
            ->make(true);
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

        $group_image=FileUploadService::fileUpload($request->file('group_image'), '/groups');

        //Store Data
        try{
            Group::create([
                'group_name' => $request->group_name,
                'slug'=>str()->slug($request->group_name),
                'parent_id' => $request->parent_name,
                'group_image' => $group_image,
                'discount' => $request->discount,
                'status' => $request->status
            ]);

            notify()->success("Group Created Successfully.");
            return redirect()->back();

        }catch(Throwable $e){

            notify()->error($e->getMessage());
            return redirect()->back();
        }
        return redirect()->back();
    }

    // Edit
    public function groupEdit($id)
    {
        $groups = Group::all();
        $editGroup = Group::find($id);
        return view('backend.pages.group.editGroup', compact('editGroup','groups'));
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
            $group_image = FileUploadService::fileUpload($request->file('group_image'), '/groups');
            File::delete('images/groups/' . $updateGroup->group_image);
        }

        $updateGroup->update([
            'group_name' => $request->group_name,
            'parent_id' => $request->parent_name,
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
