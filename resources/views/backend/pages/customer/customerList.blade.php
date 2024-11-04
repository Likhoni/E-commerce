@extends('backend.master')

@section('content')
    <div style="padding:20px">
        <h1>Customer List</h1>
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

                @foreach ($customer as $key=> $data)
                    <tr>
                        <th>{{ $customer-> firstItem()+$key}}</th>
                        <td>{{ $data->first_name }}</td>
                        <td>{{ $data->last_name }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->phone_number }}</td>
                        <td><img style="width: 100px;height:100px" src="{{ url('images/customers', $data->image) }}"
                                alt="" srcset=""></td>
                        <td>{{ $data->address }}</td>
                        <td>
                        {{-- @if (checkPermission('customer.delete'))
                            <a href="{{ route('customer.delete', $data->id) }}" class="btn btn-danger">Delete</a>
                        @endif --}}
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    {{$customer->links()}}
@endsection
