<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    //list
    public function customerList()
    {
        $customer = Customer::all();
        return view('backend.pages.customer.customerList', compact('customer'));
    }

    public function ajaxDataTable()
    {
        $data = Customer::select('customers.*'); // Select all necessary fields from the customers table.
    
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('full_name', function ($row) {
                return $row->full_name;
            })
            ->addColumn('customer_image', function ($row) {
                if ($row->image) {
                    return '<img src="' . asset('images/customers/' . $row->image) . '" style="width: 100px; height: 100px;"/>';
                }
                return '<img src="' . asset('images/default.avif') . '" style="width: 100px; height: 100px;" />';
            })
            ->addColumn('action', function ($row) {
                return '<a href="javascript:void(0)" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
            })
            ->rawColumns(['customer_image', 'action'])
            ->make(true);
    }
    

    // public function customerDelete()

    // {
    //    try {
    //       $customer = Customer::find(auth('customerGuard')->user()->id);
    //       $customer->delete();
    //       notify()->success('Customer Deleted Successfully.');
    //       return redirect()->back();

    //    } catch (Throwable $ex) {

    //       notify()->error("This Customer Has Order, You Cannot Delete It");
    //       return redirect()->back();
    //    }
    // }


}
