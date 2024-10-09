@extends('backend.master')

@section('content')
    <div style="padding:20px">
        <h1>Order List</h1>
        <div><a href="{{ route('admin.order.form') }}" class="btn btn-primary">Add New Order</a></div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Receiver Name</th>
                    <th scope="col">Receiver Email</th>
                    <th scope="col">Receiver Mobile</th>
                    <th scope="col">Receiver Address</th>
                    <th scope="col">Status</th>
                    <th scope="col">Payment Method</th>
                    <th scope="col">Payment Status</th>
                    <th scope="col">Order Number</th>
                    <th scope="col">Total Amount</th>
                    <th scope="col">Total Discount</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order as $data)
                    <tr>
                        <th>{{ $data->id }}</th>
                        <td>{{ $data->receiver_name }}</td>
                        <td>{{ $data->receiver_email }}</td>
                        <td>{{ $data->receiver_mobile }}</td>
                        <td>{{ $data->receiver_address }}</td>
                        <td>{{ $data->status }}</td>
                        <td>{{ $data->payment_method }}</td>
                        <td>{{ $data->payment_status }}</td>
                        <td>{{ $data->order_number }}</td>
                        <td>{{ $data->total_amount }}</td>
                        <td>{{ $data->total_discount }}</td>
                        <td>
                            <a href="{{ route('admin.order.edit', $data->id) }}" class="btn btn-success">Edit</a>
                            <a href="{{ route('admin.order.delete', $data->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
