@extends('backend.master')
@section('content')
    <div style="padding: 20px;">
        <div style="padding:10px;">
            <a href="{{ route('admin.order.detail.list') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>


        <form action="{{ route('admin.submit.order.detail.form') }}" method="post" enctype="multipart/form-data">

            @csrf
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h1><strong>Order Detail Create Form </strong></h1><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Unit Price</strong></label>
                            <input required name="product_unit_price" type="number" class="form-control" id="exampleFormControlInput1"
                                placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Quantity</strong></label>
                            <input required name="product_quantity" type="number" class="form-control" id="exampleFormControlInput1"
                                placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Subtotal</strong></label>
                            <input required name="subtotal" type="number" class="form-control" id="exampleFormControlInput1"
                                placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Discount</strong></label>
                            <input required name="discount" type="number" class="form-control" id="exampleFormControlInput1"
                                placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Discount Price</strong></label>
                            <input required name="discount_price" type="number" class="form-control" id="exampleFormControlInput1"
                                placeholder="">
                        </div><br>

                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
