@extends('backend.master')

@section('content')

<h1>Product List</h1>
<div><a href="{{route('admin.product.form')}}" class="btn btn-primary">Add New Product</a></div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Product Name</th>
      <th scope="col">Category Name</th>
      <th scope="col">Product Quantity</th>
      <th scope="col">Product Price</th>
      <th scope="col">Product Image</th>
      <th scope="col">Product Description</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

    @foreach($product as $data)
    <tr>
      <th>{{$data->id}}</th>
      <td>{{$data->product_name}}</td>
      <td>{{$data->category->category_name}}</td>
      <td>{{$data->product_quantity}}</td>
      <td>{{$data->product_price}}</td>
      <td>{{$data->product_image}}</td>
      <td>{{$data->product_description}}</td>
      <td>
        <a href="{{route('admin.product.edit',$data->id)}}" class="btn btn-success">Edit</a>
        <a href="{{route('admin.product.delete', $data->id)}}" class="btn btn-danger">Delete</a>
      </td>
    </tr>
    @endforeach

  </tbody>
</table>

@endsection