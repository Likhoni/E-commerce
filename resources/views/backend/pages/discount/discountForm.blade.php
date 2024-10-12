@extends('backend.master')

@section('content')
<div style="padding: 20px;">

    <div style="padding:10px;">
        <a href="{{ route('admin.discount.list') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <form action="{{ route('admin.submit.discount.form') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">

                    <h1><strong>Discount Create Form</strong></h1><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Discount Name</strong></label>
                        <input name="discount_name" type="text" class="form-control"
                            id="exampleFormControlInput1" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Category Name</strong></label>
                        <select name="" id="">
                            <option value=""></option>
                        </select>
                        <input name="category_name" type="text" class="form-control"
                            id="exampleFormControlInput1" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Product Name</strong></label>
                        <select name="" id="">
                            <option value=""></option>
                        </select>
                        <input name="product_name" type="text" class="form-control"
                            id="exampleFormControlInput1" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for=""><strong>Discount Percentage</strong></label>
                        <input name="discount_percentage" type="number" class="form-control" id="" placeholder="">
                    </div><br>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection