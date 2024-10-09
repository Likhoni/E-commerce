<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class OrderController extends Controller
{
    //list
    public function orderList()
    {
        $order = Order::all();
        return view('backend.pages.order.orderList', compact('order'));
    }

    //create
    public function orderForm()
    {
        return view('backend.pages.order.orderForm');
    }

    //store
    public function SubmitOrderForm(Request $request)
    {
        //dd(request()->all());
        //Validation
        $checkValidation = Validator::make($request->all(), [
            //'customer_id' => 'required',
            'receiver_name' => 'required',
            'receiver_email' => 'required',
            'receiver_mobile' => 'required',
            'receiver_address' => 'required',
            'status' => 'required',
            'payment_method' => 'required',
            'payment_status' => 'required',
            'total_amount' => 'required',
            'total_discount' => 'required',
             
        ]);
        
        if ($checkValidation->fails()) {
            notify()->error($checkValidation->getMessageBag());
            //notify()->error("Something Went Wrong");
            return redirect()->back();
        }

        //Store Data
        Order::create([
            //'customer_id' => $request->customer_id,
            'receiver_name' => $request->receiver_name,
            'receiver_email' => $request->receiver_email,
            'receiver_mobile' => $request->receiver_mobile,
            'receiver_address' => $request->receiver_address,
            'status' => $request->status,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_status,
            'order_number' => $request->order_number,
            'total_amount' => $request->total_amount,
            'total_discount' => $request->total_discount,
        ]);
        notify()->success("Order Created successfully.");
        return redirect()->back();
    }

    // Edit
    public function orderEdit($id)
    {
        $editOrder = Order::find($id);
        return view('backend.pages.order.editOrder', compact('editOrder'));
    }

    //Update 
    public function orderUpdate(Request $request, $id)
    {
        $updateOrder = Order::find($id);
        $checkValidation = Validator::make($request->all(), [
            //'customer_id' => 'required',
            'receiver_name' => 'required',
            'receiver_email' => 'required',
            'receiver_mobile' => 'required',
            'receiver_address' => 'required',
            'status' => 'required',
            'payment_method' => 'required',
            'payment_status' => 'required',
            'total_amount' => 'required',
            'total_discount' => 'required',
         ]);
         if ($checkValidation->fails()) {
             // notify()->error($checkValidation->getMessageBag());
             notify()->error("Something Went Wrong");
             return redirect()->back();
         }
        $updateOrder->update([
            //'customer_id' => $request->customer_id,
            'receiver_name' => $request->receiver_name,
            'receiver_email' => $request->receiver_email,
            'receiver_mobile' => $request->receiver_mobile,
            'receiver_address' => $request->receiver_address,
            'status' => $request->status,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_status,
            'order_number' => $request->order_number,
            'total_amount' => $request->total_amount,
            'total_discount' => $request->total_discount,
        ]);
        notify()->success("Order Updated Successfully.");
        return redirect()->route('admin.order.list');
    }

    //Delete
    public function orderDelete($id)
    {
        try {

            $deleteOrder = Order::find($id);
            $deleteOrder->delete();

            notify()->success("Order Deleted Successfully.");
            return redirect()->back();
        } catch (Throwable $ex) {

            notify()->error("This Order Has Order Details, You Cannot Delete It");
            return redirect()->back();
        }
    }
}
