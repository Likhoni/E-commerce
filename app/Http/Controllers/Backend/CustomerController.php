<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    //list
    public function customerList()
    {
        $customer = Customer::all();
        return view('backend.pages.customer.customerList', compact('customer'));
    }

    // //delete
    // public function customerDelete($id)
    // {
    //     $deleteCustomer = Customer::find($id);
    //     $deleteCustomer->delete();

    //     notify()->success('Customer Deleted Successfully.');
    //     return redirect()->back();
    // }
}
