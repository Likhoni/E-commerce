<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function customerList()
    {
        $customer = Customer::all();
        return view('backend.pages.customer.customerList', compact('customer'));
    }

    public function customerForm()
    {
        return view('backend.pages.customer.customerForm');
    }

    public function SubmitCustomerForm(Request $request)
    {

        //Validation
        $checkValidation = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            // 'customer_image' => 'required'
            'address' => 'required'
        ]);
        if ($checkValidation->fails()) {
            notify()->error($checkValidation->getMessageBag());
            return redirect()->back();
        }

        Customer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'image' => $request->customer_image,
            'address' => $request->address
        ]);
        notify()->success("customer reg successful.");
        return redirect()->back();
    }

    //Edit
    public function customerEdit($id)
    {
        $editCustomer = Customer::find($id);
        return view('backend.pages.customer.editCustomer', compact('editCustomer'));
    }

    public function customerUpdate(Request $request, $id)
    {

        $checkValidation = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            // 'customer_image' => 'required'
            'address' => 'required'
        ]);
        if ($checkValidation->fails()) {
            notify()->error($checkValidation->getMessageBag());
            return redirect()->back();
        }

        $updateCustomer = Customer::find($id);
        $updateCustomer->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'image' => $request->customer_image,
            'address' => $request->address
        ]);
        notify()->success("Customer Edit successful.");
        return redirect()->route('admin.customer.list');
    }

    //delete
    public function customerDelete($id)
    {
        $deleteCustomer = Customer::find($id);
        $deleteCustomer->delete();

        notify()->success('Custeomer Delete Successful.');
        return redirect()->back();
    }
}
