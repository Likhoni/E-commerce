<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    //list
    public function categoryList()
    {
        $category = Category::with('parent')->get();
        return view('backend.pages.category.categoryList', compact('category'));
    }

    public function ajaxDataTable()
    {

        $data = Category::with('parent')->select('categories.*');

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('parent_category', function ($row) {
                return $row->parent ? $row->parent->category_name : 'N/A';
            })
            ->addColumn('category_image', function($row){
                if ($row->category_image) {
                    return '<img src="' . asset('images/categories/' . $row->category_image) . '" width="100" height="100" />';
                }
                return '<img src="' . asset('images/default.avif') . '" width="100" height="100" />';
            })

            ->addColumn('action', function ($row) {

                $editUrl = route('category.edit', $row->id);
                $deleteUrl = route('category.delete', $row->id);

                return '<a href="' . $editUrl . '" class="view btn btn-primary btn-sm">Edit</a>
                <a href="javascript:void(0)" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
            })
            ->rawColumns(['category_image','action'])
            ->make(true);
    }



    //create
    public function categoryForm()
    {
        $categories = Category::all();
        return view('backend.pages.category.categoryForm', compact('categories'));
    }

    //store
    public function submitCategoryForm(Request $request)
    {
        //Validation
        $checkValidation = Validator::make($request->all(), [
            'category_name' => 'required',
            // 'category_image' => 'required',
            // 'discount' => ['required', 'numeric', 'min:1']
        ]);
        if ($checkValidation->fails()) {
            // notify()->error($checkValidation->getMessageBag());
            notify()->error("Something Went Wrong");
            return redirect()->back();
        }

        $category_image = '';
        if ($request->hasFile('category_image')) {
            $category_image = date('YmdHis') . '.' . $request->file('category_image')->getClientOriginalExtension();
            $request->file('category_image')->storeAs('/categories', $category_image);
        }

        //Store Data
        Category::create([
            'category_name' => $request->category_name,
            'parent_id' => $request->parent_name,
            'category_image' => $category_image,
            'discount' => $request->discount
        ]);

        Log::alert('Category Created');
        notify()->success("Category Created Successfully.");
        return redirect()->back();
    }

    // Edit
    public function categoryEdit($id)
    {
        $categories = Category::all();
        $editCategory = Category::find($id);
        return view('backend.pages.category.editCategory', compact('editCategory', 'categories'));
    }

    //Update 
    public function categoryUpdate(Request $request, $id)
    {
        $updateCategory = Category::find($id);
        $checkValidation = Validator::make($request->all(), [
            'category_name' => 'required',
            // 'category_image' => 'required',
            // 'discount' => ['required', 'numeric', 'min:1']
        ]);
        if ($checkValidation->fails()) {
            // notify()->error($checkValidation->getMessageBag());
            notify()->error("Something Went Wrong");
            return redirect()->back();
        }

        $category_image = $updateCategory->category_image;

        if ($request->hasFile('category_image')) {

            $category_image = date('YmdHis') . '.' . $request->file('category_image')->getClientOriginalExtension();

            $request->file('category_image')->storeAs('/categories', $category_image);
            File::delete('images/categories/' . $updateCategory->category_image);
        }

        $updateCategory->update([
            'category_name' => $request->category_name,
            'parent_id' => $request->parent_name,
            'category_image' => $category_image,
            'discount' => $request->discount
        ]);
        notify()->success("Category Updated Successfully.");
        return redirect()->route('category.list');
    }

    //Delete
    public function categoryDelete($id)
    {
        try {

            $deleteCategory = Category::find($id);
            $deleteCategory->delete();

            notify()->success("Category Deleted Successfully.");
            return redirect()->back();
        } catch (Throwable $ex) {

            notify()->error("This Category Has Product, You Cannot Delete It");
            return redirect()->back();
        }
    }
}
