@extends('backend.master')

@section('content')
    <div style="padding: 20px;">

        <div style="padding:10px;">
            <a href="{{ route('admin.category.list') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        <form action="{{ route('admin.submit.category.form') }}" method="post" enctype="multipart/form-data">

            @csrf
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">

                        <h1><strong>Category Create Form</strong></h1><br>
                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Category Name</strong></label>
                            <input required name="category_name" type="text" class="form-control"
                                id="exampleFormControlInput1" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Category Parent Name</strong></label><br>
                            <select name="parent_name" id="parent_name" class="form-control">
                                <option value="">--Select Parent Name--</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div><br>


                        <div class="form-group">
                            <label for=""><strong>Category Image</strong></label>
                            <input name="category_image" type="file" class="form-control" id="" placeholder="">
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
