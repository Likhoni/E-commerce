@extends('backend.master')

@section('content')

<div style="padding: 20px;">
    <div style="padding:10px;">
        <a href="{{ route('order.list') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Price</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Discount Price</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $subTotal = 0; // Initialize subtotal
                    @endphp

                    @foreach($details as $data)
                    @php
                        $totalPrice = $data->quantity * $data->product_price;
                        $discountAmount = ($totalPrice * $data->discount) / 100;
                        $discountPrice = $totalPrice - $discountAmount;
                        $subTotal += $discountPrice; // Accumulate subtotal
                    @endphp
                    <tr>
                        <td>
                            <img src="{{ asset('path/to/images/' . $data->image) }}" 
                                 alt="Product Image" 
                                 style="width: 100px; height:100px;">
                        </td>
                        <td>{{ $data->product_name }}</td>
                        <td>{{ $data->quantity }}</td>
                        <td>{{ number_format($data->product_price) }}</td>
                        <td>{{ number_format($totalPrice) }}</td>
                        <td>{{ $data->discount }}%</td>
                        <td>{{ number_format($discountPrice) }}</td>
                    </tr>
                    @endforeach

                    <!-- Sub Total Row -->
                    <tr>
                        <td><strong>Sub Total</strong></td>
                        <td colspan="5"></td> <!-- Empty columns to align -->
                        <td colspan="2">{{ number_format($subTotal) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
