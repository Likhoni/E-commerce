<?php

namespace App\Http\Controllers\Backend;

use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Imports\ProductsImport;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Group;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
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
        $alertQuantity = session()->get('alert', 0);

        $data = Product::with('category', 'group')->select('products.*');

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('group_name', function ($row) {
                return $row->group ? $row->group->group_name : 'N/A';
            })
            ->addColumn('category_name', function ($row) {
                return $row->category ? $row->category->category_name : 'N/A';
            })
            ->addColumn('brand_name', function ($row) {
                return $row->brand ? $row->brand->brand_name : 'N/A';
            })
            ->addColumn('product_image', function ($row) {
                if ($row->image) {
                    return '<img src="' . asset('images/products/' . $row->image) . ' "style="width: 100px; height: 100px;"/>';
                }
                return '<img src="' . asset('images/default.avif') . ' "style="width: 100px; height: 100px;" />';
            })
            ->addColumn('product_quantity', function ($row) use ($alertQuantity) {
                $style = $row->product_quantity < $alertQuantity ?
                    'background-color: red; color: white; display: inline-block; height: 50px; width: 50px; text-align: center; padding:12px;' : '';
                return '<span style="' . $style . '">' . $row->product_quantity . '</span>';
            })
            ->addColumn('action', function ($row) {
                $viewUrl = route('product.view', $row->id);
                $editUrl = route('product.edit', $row->id);
                $deleteUrl = route('product.delete', $row->id);

                return '<a href="' . $viewUrl . '" class="view btn btn-primary btn-sm">View</a>
                        <a href="' . $editUrl . '" class="view btn btn-success btn-sm">Edit</a>
                        <a href="javascript:void(0)" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
            })
            ->rawColumns(['product_image', 'product_quantity', 'action'])
            ->make(true);
    }

    //create
    public function productForm()
    {
        $varCategory = Category::doesntHave('child')->get();
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
            'image' => 'required',
            // 'product_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
            'discount' => 'nullable|numeric|min:0|max:100',
        ]);

        if ($checkValidation->fails()) {
            // notify()->error($checkValidation->getMessageBag());
            Log::error('Product not created');
            notify()->error("Something Went Wrong");
            return redirect()->back();
        }


        $image=FileUploadService::fileUpload($request->file('image'), '/products');


        $product = Product::create([
            'product_name' => $request->product_name,
            'group_id' => $request->group_id,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'product_quantity' => $request->product_quantity,
            'product_price' => $request->product_price,
            'image' => $image,
            'discount' => $request->discount,
            'discount_price' => $request->discount_price,
            'product_description' => $request->description
        ]);

        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $file) {
                $imageName = date('YmdHis') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('/products', $imageName);

                ProductImage::create([
                    'product_id' => $product->id,
                    'image_url' => $imageName
                ]);
            }
            Log::alert('Product Created');
        }
        notify()->success("Product Created Successfully.");
        return redirect()->back();
    }

    //view
    public function productView($id)
    {
        $viewProduct = Product::find($id);
        $allImages = ProductImage::where('product_id', $id)->get();
        return view('backend.pages.product.viewProduct', compact('viewProduct', 'allImages'));
    }

    //Edit
    public function productEdit($id)
    {
        $varCategory = Category::all();
        $varGroup = Group::all();
        $varBrand = Brand::all();
        $editProduct = Product::find($id);
        $varImages = ProductImage::where('product_id', $id)->get(); // Fetch only related images

        return view('backend.pages.product.editProduct', compact('editProduct', 'varCategory', 'varGroup', 'varBrand', 'varImages'));
    }


    //Update
    public function productUpdate(Request $request, $id)
    {
        $updateProduct = Product::find($id);

        $checkValidation = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_quantity' => ['required', 'numeric', 'min:1'],
            'product_price' => 'required',
            'image' => 'nullable|image',
        ]);

        if ($checkValidation->fails()) {
            notify()->error("Validation Failed");
            return redirect()->back();
        }

        // Handle main product image update
        $image = $updateProduct->image;
        if ($request->hasFile('image')) {
            $image = date('YmdHis') . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('/products', $image);
            File::delete('images/products/' . $updateProduct->image);
        }

        $updateProduct->update([
            'product_name' => $request->product_name,
            'group_id' => $request->group_id,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'product_quantity' => $request->product_quantity,
            'product_price' => $request->product_price,
            'image' => $image,
            'discount' => $request->discount,
            'discount_price' => $request->discount_price,
            'product_description' => $request->description,
        ]);

        // Handle additional images deletion
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $productImage = ProductImage::find($imageId);
                if ($productImage) {
                    File::delete('images/products/' . $productImage->image_url);
                    $productImage->delete();
                }
            }
        }

        // Handle new additional images
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $file) {
                $imageName = date('YmdHis') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('/products', $imageName);

                ProductImage::create([
                    'product_id' => $updateProduct->id,
                    'image_url' => $imageName,
                ]);
            }
        }

        notify()->success("Product Updated Successfully.");
        return redirect()->route('product.list');
    }


    //delete
    public function productDelete($id)
    {
        try {
            $deleteProduct = Product::findOrFail($id);
            $deleteProduct->delete();

            notify()->success("Product Deleted Successfully.");
            return redirect()->back();
        } catch (Throwable $ex) {
            notify()->error("This Product is Parent Table, You Cannot Delete It.");
            return redirect()->back();
        }
    }

    public function setAlertStock(Request $request)
    {
        session()->put('alert', $request->alert_quantity);
        return redirect()->back();
    }

    public function productExport()
    {
        return Excel::download(new ProductsExport,'product_'.date('Y-m-d').'.xlsx');
    }

    public function productImport(Request $request)
    {
        // dd($request->all());
        try
        {
            Excel::import(new ProductsImport, $request->file('file'));
            notify()->success('Product Imported Successfully.');
            return redirect()->route('product.list');

        }catch(\Exception $ex){
           Log::info($ex);
           notify()->error($ex->getMessage());
           return redirect()->route('product.list');
        }
          
    }
}
