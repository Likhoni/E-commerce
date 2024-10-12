@extends('backend.master')

@section('content')
    <div style="padding:20px">
        <h1>Customer List</h1>
        <div><a href="{{ route('customer.form') }}" class="btn btn-primary">Add New Customer</a></div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">E-Mail</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Image</th>
                    <th scope="col">Address</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($customer as $data)
                    <tr>
                        <th>{{ $data->id }}</th>
                        <td>{{ $data->first_name }}</td>
                        <td>{{ $data->last_name }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->phone_number }}</td>
                        <td>{{ $data->image }}</td>
                        <td>{{ $data->address }}</td>
                        <td>
                            <a href="{{ route('customer.edit', $data->id) }}" class="btn btn-success">Edit</a>
                            <a href="{{ route('customer.delete', $data->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
