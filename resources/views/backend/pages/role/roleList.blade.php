@extends('backend.master')

@section('content')
    <div style="padding:20px">
        <h1>Role List</h1>
        @if (checkPermission('role.form'))
            <div><a href="{{ route('role.form') }}" class="btn btn-primary">Add New Role</a></div>
        @endif
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
                        @if (checkPermission('role.edit'))
                            <a href="{{ route('role.edit', $data->id) }}" class="btn btn-success">Edit</a>
                        @endif
                        @if (checkPermission('role.delete'))
                            <a href="{{ route('role.delete', $data->id) }}" class="btn btn-danger">Delete</a>
                        @endif
                        @if (checkPermission('role.assign.permission') && $data->name != 'Super Admin')
                            <a href="{{ route('role.assign.permission', $data->id) }}" class="btn btn-success">Assign
                                Permission</a>
                        @endif
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
