@extends("backend.master")

@section('content')
<div style="padding-left: 10px;">

    <form action="{{route('admin.product.update', $editProduct->id)}}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h1><strong>Edit Product</strong></h1><br>


                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Product Name</strong></label>
                        <input required value="{{$editProduct->product_name}}" name="product_name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for=""><strong>Product Quantity</strong></label>
                        <input required value="{{$editProduct->product_quantity}}" name="product_quantity" type="text" class="form-control" id="" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for=""><strong>Product Price</strong></label>
                        <input required value="{{$editProduct->product_price}}" name="product_price" type="number" class="form-control" id="" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for=""><strong>Product Image</strong></label>
                        <input value="{{$editProduct->product_image}}" name="product_image" type="file" class="form-control" id="" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"><strong>Description</strong></label>
                        <input required value="{{$editProduct->product_description}}" name="description" type="text" class="form-control" id="" placeholder="">
                    </div><br>

                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection