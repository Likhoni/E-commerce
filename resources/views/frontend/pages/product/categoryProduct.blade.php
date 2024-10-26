@extends('frontend.master')
@section('content')
    <div class="container product_section_container">
        <div class="row">
            <div class="col product_section clearfix" style="padding-top:100px;">

                <!-- Sidebar -->

                <div class="sidebar">
                    <div class="sidebar_section">
                        <div class="sidebar_title">
                            <h5>Product Category</h5>
                        </div>
                        <ul class="sidebar_categories">
                            @foreach ($categories as $data)
                                <li class="active">
                                    <a href="#"><span><i class="fa fa-angle-double-right"
                                                aria-hidden="true"></i></span>
                                        {{ $data->category_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Main Content -->

                <div class="main_content">

                    <!-- Products -->

                    <div class="products_iso">
                        <div class="row">
                            <div class="col">
                                <!-- Product Grid -->

                                <div class="product-grid">

                                    <!-- Product 1 -->

                                    <div class="product-item men">
                                        <div class="product discount product_filter">
                                            <div class="product_image">
                                                <img src="{{ url('frontend/images/product_1.png') }}" alt="">
                                            </div>
                                            <div class="favorite favorite_left"></div>
                                            <div
                                                class="product_bubble product_bubble_right product_bubble_red d-flex flex-column align-items-center">
                                                <span>-$20</span>
                                            </div>
                                            <div class="product_info">
                                                <h6 class="product_name"><a href="single.html">Fujifilm X100T 16 MP
                                                        Digital Camera (Silver)</a></h6>
                                                <div class="product_price">$520.00<span>$590.00</span></div>
                                            </div>
                                        </div>
                                        <div class="red_button add_to_cart_button"><a href="#">add to cart</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
