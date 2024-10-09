@extends('backend.master')

@section('content')
    <div style="padding:20px">
        <h1>Role List</h1>
        <div><a href="{{ route('admin.role.form') }}" class="btn btn-primary">Add New Role</a></div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($role as $data)
                    <tr>
                        <th>{{ $data->id }}</th>
                        <td>{{ $data->name }}</td>
                        <td>{{ $data->status }}</td>
                        <td>
                            <a href="{{ route('admin.role.edit', $data->id) }}" class="btn btn-success">Edit</a>
                            <a href="{{ route('admin.role.delete', $data->id) }}" class="btn btn-danger">Delete</a>
                            <a href="{{ route('admin.role.assign.permission', $data->id) }}" class="btn btn-success">Assign
                                Permission</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
