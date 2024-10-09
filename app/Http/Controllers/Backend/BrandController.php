<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class BrandController extends Controller
{
    //list
    public function brandList()
    {
        $brand = Brand::with('parentBrand')->get();
        return view('backend.pages.brand.brandList', compact('brand'));
    }

    //create
    public function brandForm()
    {
        $brands = Brand::all();
        return view('backend.pages.brand.brandForm', compact('brands'));
    }

    //store
    public function submitBrandForm(Request $request)
    {
        //Validation
        $checkValidation = Validator::make($request->all(), [
            'brand_name' => 'required',
            // 'brand_image' => 'required',
            // 'discount' => ['required', 'numeric', 'min:1']
        ]);
        if ($checkValidation->fails()) {
            // notify()->error($checkValidation->getMessageBag());
            notify()->error("Something Went Wrong");
            return redirect()->back();
        }

        //Store Data
        Brand::create([
            'brand_name' => $request->brand_name,
            'parent_id' => $request->parent_name,
            'brand_image' => $request->brand_image,
            'discount' => $request->discount
        ]);
        notify()->success("Brand Created Successfully.");
        return redirect()->back();
    }

    // Edit
    public function brandEdit($id)
    {
        $editBrand = Brand::find($id);
        return view('backend.pages.brand.editBrand', compact('editBrand'));
    }

    //Update 
    public function brandUpdate(Request $request, $id)
    {
        $updateBrand = Brand::find($id);
        $checkValidation = Validator::make($request->all(), [
            'brand_name' => 'required',
            // 'brand_image' => 'required',
            // 'discount' => ['required', 'numeric', 'min:1']
         ]);
         if ($checkValidation->fails()) {
             // notify()->error($checkValidation->getMessageBag());
             notify()->error("Something Went Wrong");
             return redirect()->back();
         }
        $updateBrand->update([
            'brand_name' => $request->brand_name,
            'brand_image' => $request->brand_image,
            'discount' => $request->discount
        ]);
        notify()->success("Brand Updated Successfully.");
        return redirect()->route('admin.brand.list');
    }

    //Delete
    public function brandDelete($id)
    {
        try {

            $deleteBrand = Brand::find($id);
            $deleteBrand->delete();

            notify()->success("Brand Deleted Successfully.");
            return redirect()->back();
        } catch (Throwable $ex) {

            notify()->error("This Brand Has Product, You Cannot Delete It");
            return redirect()->back();
        }
    }
}
