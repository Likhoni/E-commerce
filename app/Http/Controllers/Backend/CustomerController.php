<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Throwable;

class CustomerController extends Controller
{
    //list
    public function customerList()
    {
        $customer = Customer::all();
        return view('backend.pages.customer.customerList', compact('customer'));
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
