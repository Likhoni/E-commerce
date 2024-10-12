@extends("backend.master")

@section('content')
<div style="padding: 20px;">

    <form action="{{route('order.detail.update', $editOrderDetail->id)}}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h1><strong>Update Order Detail Form</strong></h1><br>


                    <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Unit Price</strong></label>
                            <input required name="product_unit_price" type="number" class="form-control" id="exampleFormControlInput1"
                                placeholder="" value="{{$editOrderDetail->product_unit_price}}">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Quantity</strong></label>
                            <input required name="product_quantity" type="number" class="form-control" id="exampleFormControlInput1"
                                placeholder="" value="{{$editOrderDetail->product_quantity}}">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Subtotal</strong></label>
                            <input required name="subtotal" type="number" class="form-control" id="exampleFormControlInput1"
                                placeholder="" value="{{$editOrderDetail->subtotal}}">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Discount</strong></label>
                            <input required name="discount" type="number" class="form-control" id="exampleFormControlInput1"
                                placeholder="" value="{{$editOrderDetail->discount}}">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Discount Price</strong></label>
                            <input required name="discount_price" type="number" class="form-control" id="exampleFormControlInput1"
                                placeholder="" value="{{$editOrderDetail->discount_price}}">
                        </div><br>


                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection