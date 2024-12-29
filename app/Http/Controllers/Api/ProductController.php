<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductImage;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function getProduct()
    {
        $products = Product::with('images')->get();
        return $this->responseSuccess(ProductResource::collection($products),'All Products.');
    }

    public function getSingleProduct($id)
    {
        $products=Product::find($id);
        return $this->responseSuccess(ProductResource::make($products),'Single Product');
    }

    public function createProduct(Request $request)
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
            return $this->responseFailed($checkValidation->getMessageBag());
        }


        $image = FileUploadService::fileUpload($request->file('image'), '/products');


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
        }
        return $this->responseSuccess($product,'Product Created successfully.');
    }

    public function updateProduct(Request $request, $id)
    {
        $updateProduct = Product::find($id);

        $checkValidation = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_quantity' => ['required', 'numeric', 'min:1'],
            'product_price' => 'required',
            'image' => 'nullable|image',
        ]);

        if ($checkValidation->fails()) {
            return $this->responseFailed($checkValidation->getMessageBag());
        }

        // Handle main product image update
        $image = $updateProduct->image;
        if ($request->hasFile('image')) {
            $image = FileUploadService::fileUpload($request->file('image'), '/products');
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

        if ($request->hasFile('product_images')) {
            $oldImages = $updateProduct->images; 
        
            if ($oldImages) {
                foreach ($oldImages as $image) {
                    $filePath = public_path('images/products/' . $image->image_url);
                    if (File::exists($filePath)) {
                        File::delete($filePath);
                    }
                    $image->delete();
                }
            }
        
            // Upload and save new images
            foreach ($request->file('product_images') as $file) {
                $imageName = date('YmdHis') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('/products', $imageName);
        
                ProductImage::create([
                    'product_id' => $updateProduct->id,
                    'image_url' => $imageName,
                ]);
            }
        }

        return $this->responseSuccess($updateProduct,'Product Updated successfully.');
    }

    public function deleteProduct($id)
    {
        $deleteProduct = Product::find($id)->delete();
        return $this->responseSuccess($deleteProduct,'Product Deleted successfully.');
    }

}
