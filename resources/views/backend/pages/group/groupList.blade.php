@extends('backend.master')

@section('content')
    <div style="padding:20px">
        <h1>Group List</h1>
@if(checkPermission('group.form'))
        <div><a href="{{ route('group.form') }}" class="btn btn-primary">Add New Group</a></div>
@endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id </th>
                    <th scope="col">Group Name</th>
                    <th scope="col">Parent Group</th>
                    <th scope="col">Group Image</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($group as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->group_name }}</td>
                        <td>{{ $data->parentGroup ? $data->parentGroup->group_name : 'Null' }}</td>
                        <td><img style="width: 100px;height:100px" src="{{ url('images/groups', $data->group_image) }}"
                                alt="" srcset=""></td>
                        <td>{{ $data->discount }}%</td>
                        <td>{{ $data->status }}</td>
                        <td>
                        @if(checkPermission('group.edit'))
                            <a href="{{ route('group.edit', $data->id) }}" type="button" class="btn btn-success">Edit
                            </a>
                        @endif    
                        @if(checkPermission('group.delete'))
                            <a href="{{ route('group.delete', $data->id) }}" type="button" class="btn btn-danger">Delete
                            </a>
                        @endif    
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
