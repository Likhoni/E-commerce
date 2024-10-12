@extends('backend.master')

@section('content')
    <div style="padding:20px">
        <h1>Brand List</h1>
        <div><a href="{{ route('brand.form') }}" class="btn btn-primary">Add New Brand</a></div>

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
                        <td>{{ $data->brand_image }}</td>
                        <td>{{ $data->discount }}%</td>
                        <td>
                            <a href="{{ route('brand.edit', $data->id) }}" type="button"
                                class="btn btn-success">Edit</a>
                            <a href="{{ route('brand.delete', $data->id) }}" type="button"
                                class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
