@extends('frontend.master')
@section('content')

<!-- Slider -->
<div class="main_slider" style="background-image:url(frontend/images/slider_1.jpg)">
    <div class="container fill_height">
        <div class="row align-items-center fill_height">
            <div class="col">
                <div class="main_slider_content">
                    <h6>Spring / Summer Collection 2017</h6>
                    <h1>Get up to 30% Off New Arrivals</h1>
                    <div class="red_button shop_now_button"><a href="#">shop now</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Banner -->
<div class="banner">
    <div class="container">
        <div class="row">
            @foreach ($categories->take(3) as $data)
            <div class="col-md-4">
                <div class="banner_item align-items-center"
                    style="background-image: url('images/categories/{{ $data->category_image }}');">
                    <div class="banner_category">
                        <a href="categories.html">{{ $data->category_name }}</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- New Arrivals -->
<div class="new_arrivals">
    <div class="container">
        
        <div class="row">
            <div class="col text-center">
                <div class="section_title new_arrivals_title">
                    <h2>New Arrivals</h2>
                </div>
            </div>
        </div>

        <div class="row align-items-center">
            <div class="col text-center">
                <div class="new_arrivals_sorting">
                    <ul class="arrivals_grid_sorting clearfix button-group filters-button-group">
                        <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center active is-checked" data-filter="*">
                            all
                        </li>
                        @foreach ($categories->take(6) as $data)
                        <li class="grid_sorting_button button d-flex flex-column justify-content-center align-items-center"
                            data-filter=".{{ strtolower($data->category_name) }}">{{ $data->category_name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>

                    @foreach ($products->take(10) as $data)
                    <div class="product-item {{ strtolower($data->category->category_name) }}">
                        
                        <div class="product @if ($data->discount) discount @endif product_filter">
                            <!--Product Image-->
                            <div class="product_image">
                                <a href="{{route('frontend.single.product',$data->id )}}">
                                    <img style="height:200px; width:250px;" src="{{ $data->images->first() ? url('images/products', $data->images->first()->image_url) : url('images/placeholder.png') }}" 
                                    alt="">
                                </a>
                            </div>

                            <!-- Badge for Discount or New -->
                            @if ($data->discount)
                            <div
                                class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
                                <span>-{{ $data->discount }}%</span>
                            </div>
                            @elseif($data->is_new)
                            <div
                                class="product_bubble product_bubble_left product_bubble_green d-flex flex-column align-items-center">
                                <span>new</span>
                            </div>
                            @endif

                            <div class="favorite favorite_left"></div>
                            <div class="product_info" style="padding-bottom: 200px;">
                                <!--Product Name-->
                                <h6 class="product_name">
                                    <a href="{{route('frontend.single.product',$data->id )}}">
                                        {{ $data->product_name }}
                                    </a>
                                </h6>

                                <!--Product Price-->
                                <div class="product_price">TK. {{ $data->product_price }}
                                    @if ($data->old_price)
                                    <span>TK. {{ $data->old_price }}</span>
                                    @endif
                                </div>
                            </div> 
                        </div>

                        <!--Add to Cart Button-->
                        <div class="red_button add_to_cart_button"><a
                                href="{{ route('frontend.add.to.cart', $data->id) }}">add to cart</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection