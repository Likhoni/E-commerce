@extends('backend.master')
@section('content')
    <div style="padding: 20px;">
        <div style="padding:10px;">
            <a href="{{ route('order.list') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>


        <form action="{{ route('submit.order.form') }}" method="post" enctype="multipart/form-data">

            @csrf
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h1><strong>Order Create Form </strong></h1><br>

                        {{-- <input required name="customer_id" type="hidden" class="form-control" id="exampleFormControlInput1"
                            value="{{ auth('customerGuard')->user()->id }}" placeholder=""> --}}

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Receiver Name</strong></label>
                            <input required name="receiver_name" type="text" class="form-control"
                                id="exampleFormControlInput1" value="" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Receiver Email</strong></label>
                            <input required name="receiver_email" type="email" class="form-control"
                                id="exampleFormControlInput1" value="" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Receiver Mobile</strong></label>
                            <input required name="receiver_mobile" type="tel" class="form-control"
                                id="exampleFormControlInput1" value="" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Receiver Address</strong></label>
                            <input required name="receiver_address" type="text" class="form-control"
                                id="exampleFormControlInput1" value="" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Status</strong></label>
                            <select name="status" id="" class="form-control">
                                <option value="pending">pending</option>
                            </select>
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Payment Method</strong></label>
                            <input required name="payment_method" type="text" class="form-control"
                                id="exampleFormControlInput1" value="" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Payment Status</strong></label>
                            <select name="payment_status" id="" class="form-control">
                                <option value="pending">pending</option>
                            </select>
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Order Number</strong></label>
                            <input required name="order_number" type="text" class="form-control"
                                id="exampleFormControlInput1" value="" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Total Amount</strong></label>
                            <input required name="total_amount" type="number" class="form-control"
                                id="exampleFormControlInput1" value="" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Total Discount</strong></label>
                            <input required name="total_discount" type="number" class="form-control"
                                id="exampleFormControlInput1" value="" placeholder="">
                        </div><br>

                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
