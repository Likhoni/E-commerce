@extends('backend.master')

@section('content')
<div style="padding: 20px;">
    <div style="padding:10px;">
        <a href="{{ route('product.list') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <h1 style="padding-bottom: 20px;"><strong>View Product Details</strong></h1><br>
            <ul>
                <strong style="font-size: x-large;">Product Name : </strong>
                <h5 style="display: inline;">{{$viewProduct->product_name}}</h5>
            </ul>
            <ul>
                <strong style="font-size: x-large;">Group Name : </strong>
                <h5 style="display: inline;">{{ $viewProduct->group->group_name ?? 'Null' }}</h5>
            </ul>
            <ul>
                <strong style="font-size: x-large;">Category Name : </strong>
                <h5 style="display: inline;">{{ $viewProduct->category->category_name ?? 'Null' }}</h5>
            </ul>
            <ul>
                <strong style="font-size: x-large;">Brand Name : </strong>
                <h5 style="display: inline;">{{ $viewProduct->brand->brand_name ?? 'Null' }}</h5>
            </ul>
            <ul>
                <strong style="font-size: x-large;">Product Quantity : </strong>
                <h5 style="display: inline;">{{ $viewProduct->product_quantity}}</h5>
            </ul>
            <ul>
                <strong style="font-size: x-large;">Product Price : </strong>
                <h5 style="display: inline;">{{ $viewProduct->product_price}} TK</h5>
            </ul>
            <ul>
                <strong style="font-size: x-large;">Discount :</strong>
                <h5 style="display: inline;">{{ $viewProduct->discount}} %</h5>
            </ul>
            <ul>
                <strong style="font-size: x-large;">Discount Price : </strong>
                <h5 style="display: inline;">{{ $viewProduct->discount_price}} TK</h5>
            </ul>
            <ul>
                <strong style="font-size: x-large;">Description : </strong>
                <h5 style="display: inline;">{{ $viewProduct->product_description}}</h5>
            </ul>
            <ul>
                <strong style="font-size: x-large;">Product Image : </strong>
                <img style="width: 200px;height:200px;display: inline;" src="{{ url('images/products', $viewProduct->image) }}" alt="">
            </ul>
            <ul>
                <strong style="font-size: x-large;">More Images : </strong>
                <div class="row" style="padding-top: 10px;;">
                    @foreach($allImages as $image)
                    <img style="width: 200px;height:200px;" src="{{ url('images/products', $image->image_url) }}" alt="">
                    @endforeach
                </div>
            </ul>

        </div>
    </div>
</div>

@endsection