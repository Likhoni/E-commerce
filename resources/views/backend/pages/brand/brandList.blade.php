@extends('backend.master')

@section('content')
    <div style="padding:20px">
        <h1>Brand List</h1>
        @if (checkPermission('brand.form'))
            <div><a href="{{ route('brand.form') }}" class="btn btn-primary">Add New Brand</a></div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id </th>
                    <th scope="col">Brand Name</th>
                    <th scope="col">Parent Brand</th>
                    <th scope="col">Brand Image</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($brand as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
                        <td>{{ $data->brand_name }}</td>
                        <td>{{ $data->parentBrand ? $data->parentBrand->brand_name : 'Null' }}</td>
                        <td><img style="width: 100px;height:100px" src="{{ url('images/brands', $data->brand_image) }}"
                                alt="" srcset=""></td>
                        <td>{{ $data->discount }}%</td>
                        <td>
                            @if (checkPermission('brand.edit'))
                                <a href="{{ route('brand.edit', $data->id) }}" type="button"
                                    class="btn btn-success">Edit</a>
                            @endif
                            @if (checkPermission('brand.delete'))
                                <a href="{{ route('brand.delete', $data->id) }}" type="button"
                                    class="btn btn-danger">Delete</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
