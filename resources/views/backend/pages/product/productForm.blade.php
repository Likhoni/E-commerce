@extends("backend.master")

@section('content')
<div style="padding-left: 10px;">

    <form action="{{route('admin.submit.product.form')}}" method="post" enctype="multipart/form-data">

        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h1><strong>Product Form</strong></h1><br>


                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Product Name</strong></label>
                        <input required name="product_name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Category Name</strong></label>
                        <select name="category_id" id="" class="form-control">
                            <option value="">Select Option--</option>
                            @foreach($varProduct as $data)
                            <option value="{{$data->id}}">{{$data->category_name}}</option>
                            @endforeach
                        </select>
                    </div><br>

                    <div class="form-group">
                        <label for=""><strong>Product Quantity</strong></label>
                        <input required name="product_quantity" type="text" class="form-control" id="" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for=""><strong>Product Price</strong></label>
                        <input required name="product_price" type="number" class="form-control" id="" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for=""><strong>Product Image</strong></label>
                        <input name="product_image" type="file" class="form-control" id="" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"><strong>Description</strong></label>
                        <input required name="description" type="text" class="form-control" id="" placeholder="">
                    </div><br>

                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection