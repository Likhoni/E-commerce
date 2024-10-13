@extends('backend.master')

@section('content')
    <div style="padding:20px">
        <h1>Product List</h1>
        <div><a href="{{ route('product.form') }}" class="btn btn-primary">Add New Product</a></div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Group Name</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Brand Name</th>
                    <th scope="col">Product Quantity</th>
                    <th scope="col">Product Price</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Product Description</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $data)
                    <tr>
                        <th>{{ $data->id }}</th>
                        <td>{{ $data->product_name }}</td>
                        <td>{{ $data->group->group_name ?? 'N/A'}}</td>
                        <td>{{ $data->category->category_name ?? 'N/A'}}</td>
                        <td>{{ $data->brand->brand_name ?? 'N/A'}}</td>
                        <td>{{ $data->product_quantity }}</td>
                        <td>{{ $data->product_price }}</td>
                        <td>{{ $data->product_image }}</td>
                        <td>{{ $data->product_description }}</td>
                        <td>{{ $data->discount }}%</td>
                        <td>
                            <a href="{{ route('product.edit', $data->id) }}" class="btn btn-success">Edit</a>
                            <a href="{{ route('product.delete', $data->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection