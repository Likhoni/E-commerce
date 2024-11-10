@extends('backend.master')

@section('content')
<div style="padding: 20px;">

    <form action="{{ route('category.update', $editCategory->id) }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">

                    <h1><strong>Update Category Form</strong></h1><br>
                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Category Name</strong></label>
                        <input required value="{{ $editCategory->category_name }}" name="category_name" type="text"
                            class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Category Parent Name</strong></label><br>
                        <select name="parent_name" id="parent_name" class="form-control">
                            <option value="">None</option> <!-- Allows null selection -->
                            @if($editCategory->parent_id)
                            <option value="{{ $editCategory->parent_id }}" selected>{{ $editCategory->parentCategory->category_name }}</option>
                            @endif
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div><br>


                    <div class="form-group">
                        <label for=""><strong>Category Image</strong></label>
                        <img style="width: 100px;height:100px" src="{{url('images/categories',$editCategory->category_image)}}" alt="">
                        <input value="{{ $editCategory->category_image }}" name="category_image" type="file"
                            class="form-control" id="" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for=""><strong>Discount</strong></label>
                        <input value="{{ $editCategory->discount }}" name="discount" type="number" class="form-control"
                            id="" placeholder="">
                    </div><br>

                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection