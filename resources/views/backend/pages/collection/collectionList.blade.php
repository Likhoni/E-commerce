@extends('backend.master')

@section('content')

<h1>Category List</h1>
<div><a href="{{route('admin.collection.form')}}" class="btn btn-primary">Add New Collection</a></div>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">Id </th>
            <th scope="col">Collection Name</th>
            <th scope="col">Collection Image</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>

          <tr>
            @foreach($collection as $data)
            <td>{{$data->id}}</td>
            <td>{{$data->collection_name}}</td>
            <td>{{$data->collection_image}}</td>
            <td>{{$data->status}}</td>
            <td>
              <a href="{{route('admin.collection.edit',$data->id)}}" type="button" class="btn btn-success">Edit</a>
              <a href="{{route('admin.collection.delete', $data->id)}}" type="button" class="btn btn-danger">Delete</a>
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>

@endsection