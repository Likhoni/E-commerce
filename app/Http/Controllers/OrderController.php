<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function orderList()
    {
        $order = Order::all();
        return view('backend.pages.order.orderList', compact('order'));
    }

    public function orderForm()
    {
        return view('backend.pages.order.orderForm');
    }

    public function SubmitOrderForm(Request $request)
    {
        //Validation
        // dd($request->all());
        $checkValidation = Validator::make($request->all(), [
            'name' => 'required',
            // 'status' => 'required',
             
        ]);
        
        if ($checkValidation->fails()) {
            notify()->error("Something Went Wrong");
            // notify()->error($checkValidation->getMessageBag());
            return redirect()->back();
        }

        Order::create([
            'name' => $request->name,
            'status' => $request->status
        ]);
        notify()->success("Role Created successfully.");
        return redirect()->back();
    }
}
