<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function productList()
    {
        $product = Product::with('category')->get();
        return view('backend.pages.product.productList', compact('product'));
    }


    public function productForm()
    {
        $varProduct = Category::all();
        return view('backend.pages.product.productForm', compact('varProduct'));
    }

    public function SubmitProductForm(Request $request)
    {
        $checkValidation = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_quantity' => ['required', 'numeric', 'min:1'],
            'product_price' => 'required',
            // 'product_image' => 'required',
            'description' => 'required'
        ]);
        if ($checkValidation->fails()) {
            notify()->error($checkValidation->getMessageBag());
            return redirect()->back();
        }
        

         Product::create([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'product_quantity' => $request->product_quantity,
            'product_price' => $request->product_price,
            'product_image' => $request->product_image,
            'product_description' => $request->description
        ]);
        
        notify()->success("Product Added Successfully.");
        return redirect()->back();
    }

    //Edit
    public function productEdit($id)
    {
        $editProduct = Product::find($id);
        return view('backend.pages.product.editProduct', compact('editProduct'));
    }

    public function productUpdate(Request $request, $id)
    {
        $checkValidation = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_quantity' => ['required', 'numeric', 'min:1'],
            'product_image' => 'required',
            'description' => 'required'
        ]);
        if ($checkValidation->fails()) {
            notify()->error($checkValidation->getMessageBag());
            return redirect()->back();
        }

        $updateProduct = Product::find($id);
        $updateProduct->update([
            'product_name' => $request->product_name,
            'product_quantity' => $request->product_quantity,
            'product_image' => $request->product_image,
            'product_description' => $request->description
        ]);
        notify()->success("Update Successsful.");
        return redirect()->route('product.list');
    }



    //Delete
    public function productDelete($id)
    {
        $deleteProduct = Product::find($id);
        $deleteProduct->delete();

        notify()->success("Delete Successsful.");
        return redirect()->back();
    }
}
