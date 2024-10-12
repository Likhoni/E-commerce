<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class DiscountController extends Controller
{
    //list
    public function discountList()
    {
        
        $discount = Discount::all();
        return view('backend.pages.discount.discountList',compact('discount'));
    }

    //create
    public function discountForm()
    {
        // $discounts = Discount::all();
        return view('backend.pages.discount.discountForm');
    }

    //store
    public function SubmitDiscountForm(Request $request)
    {
        // //Validation
        $checkValidation = Validator::make($request->all(), [
            'discount_name' => 'required',
            'discount_percentage' => ['required', 'numeric', 'min:1']
        ]);
        if ($checkValidation->fails()) {
            // notify()->error($checkValidation->getMessageBag());
            notify()->error("Something Went Wrong");
            return redirect()->back();
        }

        //Store Data
        Discount::create([
            'discount_name' => $request->discount_name,
            'category_name' => $request->category_name,
            'product_name' => $request->product_name,
            'discount_percentage' => $request->discount_percentage
        ]);
        notify()->success("Discount Created Successfully.");
        return redirect()->back();
    }

    // // Edit
    // public function categoryEdit($id)
    // {
    //     $editDiscount = Discount::find($id);
    //     return view('backend.pages.discount.editDiscount', compact('editDiscount'));
    // }

    // //Update 
    // public function discountUpdate(Request $request, $id)
    // {
    //     $updateDiscount = Discount::find($id);
    //     $checkValidation = Validator::make($request->all(), [
    //         'category_name' => 'required',
    //         // 'category_image' => 'required',
    //         // 'discount' => ['required', 'numeric', 'min:1']
    //      ]);
    //      if ($checkValidation->fails()) {
    //          // notify()->error($checkValidation->getMessageBag());
    //          notify()->error("Something Went Wrong");
    //          return redirect()->back();
    //      }
    //     $updateDiscount->update([
    //         'category_name' => $request->category_name,
    //         'catgory_image' => $request->category_image,
    //         'discount' => $request->discount
    //     ]);
    //     notify()->success("Category Updated Successfully.");
    //     return redirect()->route('admin.discount.list');
    // }

    // //Delete
    public function discountDelete($id)
    {
        try {

            $deleteCategory = Discount::find($id);
            $deleteCategory->delete();

            notify()->success("Discount Deleted Successfully.");
            return redirect()->back();
        } catch (Throwable $ex) {

            notify()->error("This Discount Has Product, You Cannot Delete It");
            return redirect()->back();
        }
    }
}
