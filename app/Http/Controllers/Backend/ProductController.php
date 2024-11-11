<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Group;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    //list
    public function productList()
    {
        return view('backend.pages.product.productList');
    }


    public function ajaxDataTable()
    {


        $data = Product::select('*');

        return DataTables::of($data)

            ->addIndexColumn()

            ->addColumn('product_image', function ($row) {
                return $row->images->first()
                    ? '<img src="' . asset('images/products/' . $row->images->first()->image_url) . '" width="100" height="100" />'
                    : '<img src="' . asset('images/placeholder.png') . '" width="100" height="100" />';
            })

            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" class="view btn btn-primary btn-sm">View</a>
                        <a href="javascript:void(0)" data-id="' . $row->id . '" class="edit btn btn-success btn-sm">Edit</a>
                        <a href="javascript:void(0)" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
                return $btn;
            })

            ->rawColumns(['product_image', 'action'])
            ->make(true);
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
        // dd($request->all());
        $checkValidation = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_quantity' => ['required', 'numeric', 'min:1'],
            'product_price' => 'required',
            // 'product_image' => 'required',
            // 'product_image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'discount' => 'required|numeric|min:0|max:100',
        ]);

        if ($checkValidation->fails()) {
            // notify()->error($checkValidation->getMessageBag());
            notify()->error("Something Went Wrong");
            return redirect()->back();
        }

        $product = Product::create([
            'product_name' => $request->product_name,
            'group_id' => $request->group_id,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'product_quantity' => $request->product_quantity,
            'product_price' => $request->product_price,
            'discount' => $request->discount,
            'discount_price' => $request->discount_price,
            'product_description' => $request->description
        ]);

        if ($request->hasFile('product_image')) {
            foreach ($request->file('product_image') as $file) {
                $imageName = date('YmdHis') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('/products', $imageName);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $imageName
                ]);
            }
        }
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
            // 'discount' => 'required|numeric|min:0|max:100',
            'description' => 'required'
        ]);
        if ($checkValidation->fails()) {
            // notify()->error($checkValidation->getMessageBag());
            notify()->error("Something Went Wrong");
            return redirect()->back();
        }

        $product_image = $updateProduct->product_image;

        if ($request->hasFile('product_image')) {
            $product_image = date('YmdHis') . '.' . $request->file('product_image')->getClientOriginalExtension();
            $request->file('product_image')->storeAs('/products', $product_image);
            File::delete('images/products/' . $updateProduct->product_image);
        }

        $updateProduct->update([
            'product_name' => $request->product_name,
            'group_id' => $request->group_id,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'product_quantity' => $request->product_quantity,
            'product_price' => $request->product_price,
            'product_image' => $product_image,
            'discount' => $request->discount,
            'discount_price' => $request->discount_price,
            'product_description' => $request->description
        ]);
        notify()->success("Product Updated Successsful.");
        return redirect()->route('product.list');
    }

    //Delete
    public function productDelete($id)
    {
        try {
            $deleteProduct = Product::findOrFail($id);
            $deleteProduct->delete();

            if (request()->ajax()) {
                return response()->json(['success' => "Product deleted successfully."]);
            }

            notify()->success("Product Deleted Successfully.");
            return redirect()->back();
        } catch (Throwable $ex) {
            if (request()->ajax()) {
                return response()->json(['error' => "This product is a parent table, you cannot delete it."], 400);
            }

            notify()->error("This Product is Parent Table, You Cannot Delete It");
            return redirect()->back();
        }
    }
}
