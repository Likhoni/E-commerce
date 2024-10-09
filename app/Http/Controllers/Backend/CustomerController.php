<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    //list
    public function customerList()
    {
        $customer = Customer::all();
        return view('backend.pages.customer.customerList', compact('customer'));
    }

    //create
    public function customerForm()
    {
        return view('backend.pages.customer.customerForm');
    }

    //store
    public function SubmitCustomerForm(Request $request)
    {
        //Validation
        $checkValidation = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'password' => 'required',
             
        ]);
        
        if ($checkValidation->fails()) {
            // notify()->error($checkValidation->getMessageBag());
            notify()->error("Something Went Wrong");
            return redirect()->back();
        }

        //Store Data
        Customer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone_number' => $request->phone_number,
            'image' => $request->customer_image,
            'address' => $request->address,
            
        ]);
        notify()->success("Customer Registered Successfully.");
        return redirect()->back();
    }

    //Edit
    public function customerEdit($id)
    {
        $editCustomer = Customer::find($id);
        return view('backend.pages.customer.editCustomer', compact('editCustomer'));
    }

    //Update
    public function customerUpdate(Request $request, $id)
    {

        $updateCustomer = Customer::find($id);
        $checkValidation = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            // 'customer_image' => 'required'
            'address' => 'required'
        ]);
        if ($checkValidation->fails()) {
            // notify()->error($checkValidation->getMessageBag());
            notify()->error("Something Went Wrong");
            return redirect()->back();
        }

        $updateCustomer->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'image' => $request->customer_image,
            'address' => $request->address
        ]);
        notify()->success("Customer Updated successfully.");
        return redirect()->route('admin.customer.list');
    }

    //delete
    public function customerDelete($id)
    {
        $deleteCustomer = Customer::find($id);
        $deleteCustomer->delete();

        notify()->success('Customer Deleted Successfully.');
        return redirect()->back();
    }
}
