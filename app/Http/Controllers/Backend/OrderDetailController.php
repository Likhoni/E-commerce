<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class OrderDetailController extends Controller
{
    //list
    public function orderDetailList()
    {
        $orderDetail = Order_detail::all();
        return view('backend.pages.orderDetail.orderDetailList', compact('orderDetail'));
    }

    //create
    public function orderDetailForm()
    {
        return view('backend.pages.orderDetail.orderDetailForm');
    }

    //store
    public function SubmitOrderDetailForm(Request $request)
    {
        //Validation
        $checkValidation = Validator::make($request->all(), [
            //'order_id' => 'required',
            //'product_id' => 'required',
            'product_unit_price' => 'required',
            'product_quantity' => 'required',
            'subtotal' => 'required',
            'discount' => 'required',
            'discount_price' => 'required',
             
        ]);
        
        if ($checkValidation->fails()) {
            // notify()->error($checkValidation->getMessageBag());
            notify()->error("Something Went Wrong");
            return redirect()->back();
        }

        //Store Data
        Order_detail::create([
            //'order_id' => $request->order_id,
            //'product_id' => $request->product_id,
            'product_unit_price' => $request->product_unit_price,
            'product_quantity' => $request->product_quantity,
            'subtotal' => $request->subtotal,
            'discount' => $request->discount,
            'discount_price' => $request->discount_price,
            
        ]);
        notify()->success("Order Detail Created successfully.");
        return redirect()->back();
    }

    // Edit
    public function orderDetailEdit($id)
    {
        $editOrderDetail = Order_detail::find($id);
        return view('backend.pages.orderDetail.editOrderDetail', compact('editOrderDetail'));
    }

    //Update 
    public function orderDetailUpdate(Request $request, $id)
    {
        $updateOrderDetail = Order_detail::find($id);
        $checkValidation = Validator::make($request->all(), [
            //'order_id' => 'required',
            //'product_id' => 'required',
            'product_unit_price' => 'required',
            'product_quantity' => 'required',
            'subtotal' => 'required',
            'discount' => 'required',
            'discount_price' => 'required',
         ]);
         if ($checkValidation->fails()) {
             // notify()->error($checkValidation->getMessageBag());
             notify()->error("Something Went Wrong");
             return redirect()->back();
         }
        $updateOrderDetail->update([
            //'order_id' => $request->order_id,
            //'product_id' => $request->product_id,
            'product_unit_price' => $request->product_unit_price,
            'product_quantity' => $request->product_quantity,
            'subtotal' => $request->subtotal,
            'discount' => $request->discount,
            'discount_price' => $request->discount_price,
        ]);
        notify()->success("Order Detail Updated Successfully.");
        return redirect()->route('order.detail.list');
    }

    //Delete
    public function orderDetailDelete($id)
    {

            $deleteOrderDetail = Order_detail::find($id);
            $deleteOrderDetail->delete();

            notify()->success("Order Detail Deleted Successfully.");
            return redirect()->back();
        
    }

    public function viewOrderDetails($id)
    {
        
        $details = Order_detail::where('order_id',$id)->get();
        return view('backend.pages.orderDetail.viewOrderDetails',compact('details'));
    }

}
