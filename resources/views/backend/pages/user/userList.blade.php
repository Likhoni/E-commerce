@extends('backend.master')

@section('content')
    <div style="padding:20px">
        <h1>User List</h1>
        @if (checkPermission('user.form'))
            <div><a href="{{ route('user.form') }}" class="btn btn-primary">Add New User</a></div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">E-Mail</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Image</th>
                    <th scope="col">Address</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($user as $data)
                    <tr>
                        <th>{{ $data->id }}</th>
                        <td>{{ $data->first_name }}</td>
                        <td>{{ $data->last_name }}</td>
                        <td>{{ $data->role->name }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->phone_number }}</td>
                        <td><img style="width: 100px;height:100px" src="{{ url('/images/users', $data->image) }}"
                                alt="user image" srcset=""></td>
                        <td>{{ $data->address }}</td>
                        <td>
                            @if (checkPermission('user.edit'))
                                <a href="{{ route('user.edit', $data->id) }}" class="btn btn-success">Edit</a>
                            @endif
                            @if (checkPermission('user.delete'))
                                <a href="{{ route('user.delete', $data->id) }}" class="btn btn-danger">Delete</a>
                            @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
