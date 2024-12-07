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
                        
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Unit Price</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Discount Price</th>
                        <th scope="col">Total Price</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($details as $data)
                    <tr>
                        <td>{{$data->product_name}}</td>
                        <td>{{$data->quantity}}</td>
                        <td>{{$data->product_price}}</td>
                        <td></td>
                        <td></td>
                        <td>{{$data->subtotal}}</td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection