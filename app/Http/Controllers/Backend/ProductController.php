<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Group;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class ProductController extends Controller
{
    //list
    public function productList()
    {
        $product = Product::with('category')->get();
        return view('backend.pages.product.productList', compact('product'));
    }

    //create
    public function productForm()
    {
        $varCategory = Category::all();
        $varGroup = Group::all();
        $varBrand = Brand::all();
        return view('backend.pages.product.productForm', compact('varCategory', 'varGroup', 'varBrand'));
    }

    //store
    public function SubmitProductForm(Request $request)
    {
        $checkValidation = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_quantity' => ['required', 'numeric', 'min:1'],
            'product_price' => 'required',
            // 'product_image' => 'required',
            // 'discount' => 'required',
            'description' => 'required'
        ]);
        if ($checkValidation->fails()) {
            // notify()->error($checkValidation->getMessageBag());
            notify()->error("Something Went Wrong");
            return redirect()->back();
        }
        
         Product::create([
            'product_name' => $request->product_name,
            'group_id' => $request->group_id,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'product_quantity' => $request->product_quantity,
            'product_price' => $request->product_price,
            'product_image' => $request->product_image,
            'discount' => $request->discount,
            'product_description' => $request->description
        ]);
        
        notify()->success("Product Created Successfully.");
        return redirect()->back();
    }

    //Edit
    public function productEdit($id)
    {
        $varCategory = Category::all();
        $varGroup = Group::all();
        $varBrand = Brand::all();
        $editProduct = Product::find($id);
        return view('backend.pages.product.editProduct', compact('editProduct', 'varCategory', 'varGroup', 'varBrand'));
    }

    //Update
    public function productUpdate(Request $request, $id)
    {
        $updateProduct = Product::find($id);
        $checkValidation = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_quantity' => ['required', 'numeric', 'min:1'],
            'product_price' => 'required',
            // 'product_image' => 'required',
            // 'discount' => 'required',
            'description' => 'required'
        ]);
        if ($checkValidation->fails()) {
            // notify()->error($checkValidation->getMessageBag());
            notify()->error("Something Went Wrong");
            return redirect()->back();
        }

        $updateProduct->update([
            'product_name' => $request->product_name,
            'group_id' => $request->group_id,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'product_quantity' => $request->product_quantity,
            'product_price' => $request->product_price,
            'product_image' => $request->product_image,
            'discount' => $request->discount,
            'product_description' => $request->description
        ]);
        notify()->success("Product Updated Successsful.");
        return redirect()->route('product.list');
    }

    //Delete
    public function productDelete($id)
    {
        try{
            $deleteProduct = Product::find($id);
            $deleteProduct->delete();
    
            notify()->success("Product Deleted Successsfully.");
            return redirect()->back();
        } catch (Throwable $ex) {

            notify()->error("This Product is Parent Table, You Cannot Delete It");
            return redirect()->back();

        }
        
    }
}
