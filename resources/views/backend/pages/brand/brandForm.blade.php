@extends('backend.master')

@section('content')
    <div style="padding: 20px;">

        <div style="padding:10px;">
            <a href="{{ route('brand.list') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        <form action="{{ route('submit.brand.form') }}" method="post" enctype="multipart/form-data">

            @csrf
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">

                        <h1><strong>Brand Create Form</strong></h1><br>
                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Brand Name</strong></label>
                            <input required name="brand_name" type="text" class="form-control"
                                id="exampleFormControlInput1" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Brand Parent Name</strong></label><br>
                            <select name="parent_name" id="parent_name" class="form-control">
                                <option value="">--Select Parent Name--</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                @endforeach
                            </select>
                        </div><br>


                        <div class="form-group">
                            <label for=""><strong>Brand Image</strong></label>
                            <input name="brand_image" type="file" class="form-control" id="" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for=""><strong>Discount</strong></label>
                            <input name="discount" type="number" class="form-control" id="" placeholder="">
                        </div><br>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
