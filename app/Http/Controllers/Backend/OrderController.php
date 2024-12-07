<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    //list
    public function orderList()
    {
        $order = Order::all();
        return view('backend.pages.order.orderList', compact('order'));
    }

    public function ajaxDataTable()
    {        
        $data = Order::select('orders.*');

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('division_name', function ($row) {
                return $row->division->name;
            }) 
            ->addColumn('district_name', function ($row) {
                return $row->district->name;
            })            
            ->addColumn('upazila_name', function ($row) {
                return $row->upazila->name;
            })            
            ->addColumn('union_name', function ($row) {
                return $row->union->name;
            })
            ->addColumn('action', function ($row) {
                $viewUrl = route('view.order.details', $row->id);
                $editUrl = route('order.edit', $row->id);
                $deleteUrl = route('order.delete', $row->id);

                return '<a href="' . $viewUrl . '" class="view btn btn-primary btn-sm">Details</a>
                        <a href="' . $editUrl . '" class="view btn btn-success btn-sm">Edit</a>
                        <a href="javascript:void(0)" data-id="' . $row->id . '" class="delete btn btn-danger btn-sm">Delete</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            //'contact_number' => 'required',
            'country' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'upazilla_id' => 'required',
            'address' => 'required',
            //'status' => 'required',
            //'payment_method' => 'required',
            //'payment_status' => 'required',
            'total_price' => 'required',

        ]);

        if ($checkValidation->fails()) {
            notify()->error($checkValidation->getMessageBag());
            //notify()->error("Something Went Wrong");
            return redirect()->back();
        }

        //Store Data
        Order::create([
            //'customer_id' => $request->customer_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'contact_number' => $request->contact_number,
            'country' => $request->country,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'upazilla_id' => $request->upazilla_id,
            'address' => $request->address,
            'status' => $request->status,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_status,
            'total_price' => $request->total_price,
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
            'customer_id' => 'required',
            'receiver_name' => 'required',
            'receiver_email' => 'required',
            'receiver_mobile' => 'required',
            'country' => 'required',
            'district_id' => 'required',
            'thana' => 'required',
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
            'customer_id' => $request->customer_id,
            'receiver_name' => $request->receiver_name,
            'receiver_email' => $request->receiver_email,
            'receiver_mobile' => $request->receiver_mobile,
            'country' => $request->country,
            'district_id' => $request->district_id,
            'thana' => $request->thana,
            'receiver_address' => $request->receiver_address,
            'status' => $request->status,
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_status,
            'order_number' => $request->order_number,
            'total_amount' => $request->total_amount,
            'total_discount' => $request->total_discount,
        ]);
        notify()->success("Order Updated Successfully.");
        return redirect()->route('order.list');
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
