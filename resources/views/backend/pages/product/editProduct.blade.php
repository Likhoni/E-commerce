@extends('backend.master')

@section('content')
<div style="padding: 20px;">
    <form action="{{ route('product.update', $editProduct->id) }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h1><strong>Update Product Form</strong></h1><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Product Name</strong></label>
                        <input required value="{{ $editProduct->product_name }}" name="product_name" type="text"
                            class="form-control" id="product_name" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="group_id"><strong>Group Name</strong></label>
                        <select name="group_id" id="group_id" class="form-control">
                            @if (!is_null($editProduct->group_id))
                                <option value="{{ $editProduct->group_id }}" selected>
                                    {{ $editProduct->group->group_name }}
                                </option>
                            @endif
                            <option value="" {{ is_null($editProduct->group_id) ? 'selected' : '' }}>No Group</option>
                            @foreach ($varGroup as $data)
                                <option value="{{ $data->id }}"
                                    {{ $editProduct->group_id == $data->id ? 'selected' : '' }}>
                                    {{ $data->group_name }}
                                </option>
                            @endforeach
                        </select>
                    </div><br>

                    <div class="form-group">
                        <label for="category_id"><strong>Category Name</strong></label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="{{ $editProduct->category_id }}">{{ $editProduct->category->category_name }}</option>
                            @foreach ($varCategory as $data)
                                <option value="{{ $data->id }}">{{ $data->category_name }}</option>
                            @endforeach
                        </select>
                    </div><br>

                    <div class="form-group">
                        <label for="brand_id"><strong>Brand Name</strong></label>
                        <select name="brand_id" id="brand_id" class="form-control">
                            @if (!is_null($editProduct->brand_id))
                                <option value="{{ $editProduct->brand_id }}" selected>
                                    {{ $editProduct->brand->brand_name }}
                                </option>
                            @endif
                            <option value="" {{ is_null($editProduct->brand_id) ? 'selected' : '' }}>No Brand</option>
                            @foreach ($varBrand as $data)
                                <option value="{{ $data->id }}"
                                    {{ $editProduct->brand_id == $data->id ? 'selected' : '' }}>
                                    {{ $data->brand_name }}
                                </option>
                            @endforeach
                        </select>
                    </div><br>

                    <div class="form-group">
                        <label for="product_quantity"><strong>Product Quantity</strong></label>
                        <input required value="{{ $editProduct->product_quantity }}" name="product_quantity"
                            type="text" class="form-control" id="product_quantity" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="product_price"><strong>Product Price</strong></label>
                        <input required value="{{ $editProduct->product_price }}" name="product_price" type="number"
                            class="form-control" id="product_price" placeholder="" oninput="calculateDiscountPrice()">
                    </div><br>

                    <div class="form-group">
                        <label for="product_image"><strong>Product Image</strong></label>
                        <img style="width: 100px;height:100px" src="{{ url('images/products', $editProduct->product_image) }}" alt="">
                        <input value="{{ $editProduct->product_image }}" name="product_image" type="file"
                            class="form-control" id="product_image" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="description"><strong>Description</strong></label>
                        <input required value="{{ $editProduct->product_description }}" name="description"
                            type="text" class="form-control" id="description" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="discount"><strong>Discount</strong></label>
                        <input value="{{ $editProduct->discount }}" name="discount" type="number" class="form-control"
                            id="discount" placeholder="" oninput="calculateDiscountPrice()">
                    </div><br>

                    <div class="form-group">
                        <label for="discount_price"><strong>Discount Price</strong></label>
                        <input value="{{ $editProduct->discount_price }}" name="discount_price" type="number" class="form-control"
                            id="discount_price" placeholder="" readonly>
                    </div><br>

                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
   function calculateDiscountPrice() {
    const price = parseFloat(document.getElementById('product_price').value) || 0;
    const discount = parseFloat(document.getElementById('discount').value);

    let discountPrice;
    if (discount && discount > 0) {
        discountPrice = price - (price * discount / 100);
    } else {
        discountPrice = 0; // Set discount price to 0 if no discount is given
    }

    document.getElementById('discount_price').value = discountPrice.toFixed(0);
}

</script>
@endsection
