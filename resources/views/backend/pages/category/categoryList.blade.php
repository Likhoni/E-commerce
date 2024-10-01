@extends('backend.master')

@section('content')

<h1>Category List</h1>
<div><a href="{{route('admin.category.form')}}" class="btn btn-primary">Add New Category</a></div>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">Id </th>
            <th scope="col">Category Name</th>
            <th scope="col">Parent Category</th>
            <th scope="col">Category Image</th>
            <th scope="col">Discount</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>

          <tr>
            @foreach($category as $data)
            <td>{{$data->id}}</td>
            <td>{{$data->category_name}}</td>
            <td>{{ $data->parentCategory ? $data->parentCategory->category_name : 'Null' }}</td>
            <td>{{$data->category_image}}</td>
            <td>{{$data->discount}}%</td>
            <td>
              <a href="{{route('admin.category.edit',$data->id)}}" type="button" class="btn btn-success">Edit</a>
              <a href="{{route('admin.category.delete', $data->id)}}" type="button" class="btn btn-danger">Delete</a>
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>

@endsection