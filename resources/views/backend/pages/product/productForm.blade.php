@extends('backend.master')

@section('content')
<div style="padding: 20px;">
    <div style="padding:10px;">
        <a href="{{ route('product.list') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <form action="{{ route('submit.product.form') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h1><strong>Product Create Form</strong></h1><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Product Name</strong></label>
                        <input required name="product_name" type="text" class="form-control"
                            id="exampleFormControlInput1" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Group Name</strong></label>
                        <select name="group_id" id="" class="form-control">
                            <option value="">Select Option--</option>
                            @foreach ($varGroup as $data)
                            <option value="{{ $data->id }}">{{ $data->group_name }}</option>
                            @endforeach
                        </select>
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Category Name</strong></label>
                        <select name="category_id" id="" class="form-control" required>
                            <option value="">Select Option--</option>
                            @foreach ($varCategory as $data)
                            <option value="{{ $data->id }}">{{ $data->category_name }}</option>
                            @endforeach
                        </select>
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Brand Name</strong></label>
                        <select name="brand_id" id="" class="form-control">
                            <option value="">Select Option--</option>
                            @foreach ($varBrand as $data)
                            <option value="{{ $data->id }}">{{ $data->brand_name }}</option>
                            @endforeach
                        </select>
                    </div><br>

                    <div class="form-group">
                        <label for=""><strong>Product Quantity</strong></label>
                        <input required name="product_quantity" type="text" class="form-control" id=""
                            placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for=""><strong>Product Price</strong></label>
                        <input required name="product_price" type="number" class="form-control" id="product_price"
                            placeholder="" oninput="calculateDiscountPrice()">
                    </div><br>

                    <div class="form-group">
                        <label for=""><strong>Product Image</strong></label>
                        <input name="image" type="file" class="form-control" id="" placeholder="">
                    </div><br>                    

                    <div class="form-group">
                        <label for=""><strong>Discount (%)</strong></label>
                        <input name="discount" type="number" class="form-control" id="discount" placeholder=""
                            oninput="calculateDiscountPrice()">
                    </div><br>

                    <div class="form-group">
                        <label for=""><strong>Discount Price</strong></label>
                        <input name="discount_price" type="number" class="form-control" id="discount_price"
                            placeholder="" readonly>
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1"><strong>Description</strong></label>
                        <input name="description" type="text" class="form-control" id=""
                            placeholder="">
                    </div><br>


                    <div class="form-group">
                        <label for=""><strong>Product Images(Add More)</strong></label>
                        <input name="product_images[]" type="file" class="form-control" id="" placeholder="" multiple>
                    </div><br>

                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function calculateDiscountPrice() {
        const price = parseFloat(document.getElementById('product_price').value) || 0;
        const discount = parseFloat(document.getElementById('discount').value) || 0;
        let discountPrice;

        if (discount > 0) {
            discountPrice = price - (price * discount / 100);
        } else {
            discountPrice = 0; // Set discount price to 0 if no discount is given
        }

        document.getElementById('discount_price').value = discountPrice.toFixed(2);
    }
</script>
@endsection