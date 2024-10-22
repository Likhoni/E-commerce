@extends('backend.master')

@section('content')
    <div style="padding: 20px;">

        <form action="{{ route('brand.update', $editBrand->id) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">

                        <h1><strong>Update Brand Form</strong></h1><br>
                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Brand Name</strong></label>
                            <input required value="{{ $editBrand->brand_name }}" name="brand_name" type="text"
                                class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for=""><strong>Brand Image</strong></label>
                            <img style="width: 100px;height:100px" src="{{url('images/brands',$editBrand->brand_image)}}" alt="">
                            <input value="{{ $editBrand->brand_image }}" name="brand_image" type="file"
                                class="form-control" id="" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for=""><strong>Discount</strong></label>
                            <input value="{{ $editBrand->discount }}" name="discount" type="number" class="form-control"
                                id="" placeholder="">
                        </div><br>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
