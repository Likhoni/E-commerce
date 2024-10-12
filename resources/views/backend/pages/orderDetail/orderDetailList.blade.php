@extends('backend.master')

@section('content')
    <div style="padding:20px">
        <h1>Order Detail List</h1>
        <div><a href="{{ route('order.detail.form') }}" class="btn btn-primary">Add New Order Detail</a></div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Product Unit Price</th>
                    <th scope="col">Product Quantity</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Discount Price</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>

                
                    @foreach ($orderDetail as $data)
                    <tr>
                        <th>{{ $data->id }}</th>
                        <td>{{ $data->product_unit_price }}</td>
                        <td>{{ $data->product_quantity }}</td>
                        <td>{{ $data->subtotal }}</td>
                        <td>{{ $data->discount }}</td>
                        <td>{{ $data->discount_price }}</td>
                        <td>
                            <a href="{{ route('order.detail.edit', $data->id) }}" class="btn btn-success">Edit</a>
                            <a href="{{ route('order.detail.delete', $data->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
                

            </tbody>
        </table>
    </div>
@endsection
