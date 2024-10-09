@extends('backend.master')

@section('content')
    <div style="padding:20px">
        <h1>Group List</h1>

        <div><a href="{{ route('admin.group.form') }}" class="btn btn-primary">Add New Group</a></div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id </th>
                    <th scope="col">Group Name</th>
                    <th scope="col">Group Image</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($group as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->group_name }}</td>
                        <td>{{ $data->group_image }}</td>
                        <td>{{ $data->status }}</td>
                        <td>
                            <a href="{{ route('admin.group.edit', $data->id) }}" type="button"
                                class="btn btn-success">Edit
                            </a>
                            <a href="{{ route('admin.group.delete', $data->id) }}" type="button"
                                class="btn btn-danger">Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
