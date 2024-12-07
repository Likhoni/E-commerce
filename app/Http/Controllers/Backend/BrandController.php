<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    //list
    public function brandList()
    {
        $brand = Brand::with('parentBrand')->get();
        return view('backend.pages.brand.brandList', compact('brand'));
    }

    public function ajaxDataTable()
    {

        $data = Brand::with('parentBrand', 'category')->select('brands.*');

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('category_name', function ($row) {
                return $row->category ? $row->category->category_name : 'N/A';
            })
            ->addColumn('parent_brand', function ($row) {
                return $row->parentBrand ? $row->parentBrand->brand_name : 'N/A';
            })
            ->addColumn('brand_image', function ($row) {
                if ($row->brand_image) {
                    return '<img src="' . asset('images/brands/' . $row->brand_image) . '" width="100" height="100" />';
                }
                return '<img src="' . asset('images/default.avif') . '" width="100" height="100" />';
            })

            ->addColumn('action', function ($row) {

                $editUrl = route('brand.edit', $row->id);
                $deleteUrl = route('brand.delete', $row->id);

                return '<a href="' . $editUrl . '" class="view btn btn-primary btn-sm">Edit</a>
                <a href="javascript:void(0)" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
            })
            ->rawColumns(['brand_image', 'action'])
            ->make(true);
    }

    //create
    public function brandForm()
    {
        $varCategory = Category::all();
        $brands = Brand::all();
        return view('backend.pages.brand.brandForm', compact('brands', 'varCategory'));
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

        $brand_image = '';
        if ($request->hasFile('brand_image')) {
            $brand_image = date('YmdHis') . '.' . $request->file('brand_image')->getClientOriginalExtension();
            $request->file('brand_image')->storeAs('/brands', $brand_image);
        }

        //Store Data
        Brand::create([
            'brand_name' => $request->brand_name,
            'category_id' => $request->category_id,
            'parent_id' => $request->parent_name,
            'brand_image' => $brand_image,
            'discount' => $request->discount
        ]);
        notify()->success("Brand Created Successfully.");
        return redirect()->back();
    }

    // Edit
    public function brandEdit($id)
    {
        $varCategory = Category::all();
        $brands = Brand::all();
        $editBrand = Brand::find($id);
        return view('backend.pages.brand.editBrand', compact('editBrand', 'varCategory','brands'));
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

        $brand_image = $updateBrand->brand_image;

        if ($request->hasFile('brand_image')) {

            $brand_image = date('YmdHis') . '.' . $request->file('brand_image')->getClientOriginalExtension();

            $request->file('brand_image')->storeAs('/brands', $brand_image);
            File::delete('images/brands/' . $updateBrand->brand_image);
        }

        $updateBrand->update([
            'brand_name' => $request->brand_name,
            'category_id' => $request->category_id,
            'parent_id' => $request->parent_name,
            'brand_image' => $brand_image,
            'discount' => $request->discount
        ]);
        notify()->success("Brand Updated Successfully.");
        return redirect()->route('brand.list');
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
