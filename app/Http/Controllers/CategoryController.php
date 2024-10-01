<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function categoryList()
    {
        $category = Category::with('parentCategory')->get();
        return view('backend.pages.category.categoryList', compact('category'));
    }

    public function categoryForm()
    {
        $categories=Category::all();
        return view('backend.pages.category.categoryForm', compact('categories'));
    }

    public function submitCategoryForm(Request $request)
    {
        $checkValidation = Validator::make($request->all(), [
            'category_name' => 'required',
            // 'category_image' => 'required',
            // 'discount' => ['required', 'numeric', 'min:1']
        ]);
        if ($checkValidation->fails()) {
            notify()->error($checkValidation->getMessageBag());
            return redirect()->back();
        }

        Category::create([
            'category_name' => $request->category_name,
            'parent_id' => $request->parent_name,
            'catgory_image' => $request->category_image,
            'discount' => $request->discount
        ]);
        notify()->success("Category Added Successfully.");
        return redirect()->back();
    }

    // Edit
    public function categoryEdit($id)
    {
        $editCategory = Category::find($id);
        return view('backend.pages.category.editCategory', compact('editCategory'));
    }

    public function categoryUpadte(Request $request, $id)
    {
        $updateCategory = Category::find($id);
        $updateCategory->update([
            'category_name' => $request->category_name,
            'catgory_image' => $request->category_image,
            'discount' => $request->discount
        ]);
        notify()->success("Update Successful.");
        return redirect()->route('category.list');
    }

    //Delete
    public function categoryDelete($id)
    {
        $deleteCategory = Category::find($id);
        $deleteCategory->delete();

        notify()->success("Delete Successful.");
        return redirect()->back();
    }
}
