@extends('frontend.master')

@section('content')
<div style="padding: 180px; text-align:center">

    <h3>Profile Details</h3>

    <!-- Adding a custom class for smaller table -->
    <table class="table table-bordered" style="width: 70%; margin: auto; font-size: 0.9em;">
        <thead>
            <tr>
                <!-- Force the visibility with inline styles for testing -->
                <th style="background-color: #e9ecef; font-weight: bold; color: black; padding: 8px;">Field</th>
                <th style="background-color: #e9ecef; font-weight: bold; color: black; padding: 8px;">Details</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding: 6px;">Full Name</td>
                <td style="padding: 6px;">{{ $viewCustomer->FullName }}</td>
            </tr>

            <tr>
                <td style="padding: 6px;">Email</td>
                <td style="padding: 6px;">{{ $viewCustomer->email }}</td>
            </tr>
            <tr>
                <td style="padding: 6px;">Phone Number</td>
                <td style="padding: 6px;">{{ $viewCustomer->phone_number }}</td>
            </tr>
            <tr>
                <td style="padding: 6px;">Address</td>
                <td style="padding: 6px;">{{ $viewCustomer->address }}</td>
            </tr>
            <tr>
                <td style="padding: 6px;">Image</td>
                <td style="padding: 6px;">
                    
                    @if($viewCustomer->image)
                    <img class="img-fluid" style="width: 100px;height:100px;" src="{{ url('images/customers/' . $viewCustomer->image) }}" alt="Profile Image">
                    @else
                    <img width="80" src="{{ url('images/customers/default-image.jpg') }}" alt="No Image Available">
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
    <div style="padding:25px"> 
        <a href="{{ route('customer.edit') }}" type="button" class="btn btn-success">Edit Profile</a>
    </div>

</div>
@endsection