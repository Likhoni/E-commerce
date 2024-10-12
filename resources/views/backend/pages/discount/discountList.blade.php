@extends('backend.master')

@section('content')
    <div style="padding:20px">
        <h1>Discount List</h1>
        <div><a href="{{ route('admin.discount.form') }}" class="btn btn-primary">Add New Discount</a></div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id </th>
                    <th scope="col">Discount Name</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Discount Percentage</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody> 
                @foreach($discount as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->discount_name}}</td>
                        <td>{{$data->category_name}}</td>
                        <td>{{$data->product_name}}</td>
                        <td>{{$data->discount_percentage}}</td>
                        <td>
                            <a href="" type="button"
                                class="btn btn-success">Edit</a>

                            <a href="{{route('admin.discount.delete', $data->id)}}" type="button"
                                class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
@endsection
