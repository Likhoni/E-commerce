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
                                class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Group Name</strong></label>
                            <select name="group_id" id="group_id" class="form-control">
                                <option value="{{ $editProduct->group_id }}">{{ $editProduct->group->group_name }}</option>
                                @foreach ($varGroup as $data)
                                    <option value="{{ $data->id }}">{{ $data->group_name }}</option>
                                @endforeach
                            </select>
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Category Name</strong></label>
                            <select name="category_id" id="" class="form-control">
                                <option value="{{ $editProduct->category_id }}">{{ $editProduct->category->category_name }}
                                </option>
                                @foreach ($varCategory as $data)
                                    <option value="{{ $data->id }}">{{ $data->category_name }}</option>
                                @endforeach
                            </select>
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Brand Name</strong></label>
                            <select name="brand_id" id="" class="form-control">
                                <option value="{{ $editProduct->brand_id }}">{{ $editProduct->brand->brand_name }}
                                </option>
                                @foreach ($varBrand as $data)
                                    <option value="{{ $data->id }}">{{ $data->brand_name }}</option>
                                @endforeach
                            </select>
                        </div><br>

                        <div class="form-group">
                            <label for=""><strong>Product Quantity</strong></label>
                            <input required value="{{ $editProduct->product_quantity }}" name="product_quantity"
                                type="text" class="form-control" id="" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for=""><strong>Product Price</strong></label>
                            <input required value="{{ $editProduct->product_price }}" name="product_price" type="number"
                                class="form-control" id="" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for=""><strong>Product Image</strong></label>
                            <img style="width: 100px;height:100px" src="{{url('images/products',$editProduct->product_image)}}" alt="">
                            <input value="{{ $editProduct->product_image }}" name="product_image" type="file"
                                class="form-control" id="" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1"><strong>Description</strong></label>
                            <input required value="{{ $editProduct->product_description }}" name="description"
                                type="text" class="form-control" id="" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for=""><strong>Discount</strong></label>
                            <input value="{{ $editProduct->discount }}" name="discount" type="number" class="form-control"
                                id="" placeholder="">
                        </div><br>

                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
