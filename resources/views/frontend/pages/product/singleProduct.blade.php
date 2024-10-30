<!DOCTYPE html>
<html lang="en">

<head>
    <style type="text/css">
        .notify {
            z-index: 1000000;
            margin-top: 5%;
        }
    </style>
    @notifyCss
    <title>E-Commerce</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Colo Shop Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{ url('frontend/styles/bootstrap4/bootstrap.min.css') }}">
    <link href="{{ url('frontend/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/plugins/OwlCarousel2-2.2.1/animate.css') }}">
    <link rel="stylesheet" href="{{ url('frontend/plugins/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/styles/single_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/styles/single_responsive.css') }}">
</head>

<body>

    <div class="super_container">

        @include('frontend.partial.header')

        <div class="container single_product_container">
            <div class="row">
                <div class="col">

                    <!-- Breadcrumbs -->

                    <div class="breadcrumbs d-flex flex-row align-items-center">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><a href="categories.html"><i class="fa fa-angle-right" aria-hidden="true"></i>Men's</a>
                            </li>
                            <li class="active"><a href="#"><i class="fa fa-angle-right"
                                        aria-hidden="true"></i>Single Product</a></li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-lg-7">
                    <div class="single_product_pics">
                        <div class="row">
                            <div class="col-lg-3 thumbnails_col order-lg-1 order-2">
                                <div class="single_product_thumbnails">
                                    <ul>
                                        <li><img src="{{url('frontend/images/single_1_thumb.jpg')}}" alt=""
                                                data-image="{{url('frontend/images/single_1.jpg')}}"></li>
                                        <li class="active"><img src="{{url('frontend/images/single_2_thumb.jpg')}}" alt=""
                                                data-image="{{url('frontend/images/single_2.jpg')}}"></li>
                                        <li><img src="{{url('frontend/images/single_3_thumb.jpg')}}" alt=""
                                                data-image="{{url('frontend/images/single_3.jpg')}}"></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-9 image_col order-lg-2 order-1">
                                <div class="single_product_image">
                                    <div class="single_product_image_background"
                                        style="background-image:url('/images/products/{{ $singleProduct->product_image }}');"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="product_details">
                        <div class="product_details_title">

                            <h2>{{$singleProduct->product_name}}</h2>

                            <div class="original_price">৳{{$singleProduct->product_price}}</div>

                            <div class="product_price">৳{{$singleProduct->product_price}}</div>



                            <ul class="star_rating">
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                            </ul>

                            <div class="product_color">
                                <span>Select Color:</span>
                                <ul>
                                    <li style="background: #e54e5d"></li>
                                    <li style="background: #252525"></li>
                                    <li style="background: #60b3f3"></li>
                                </ul>
                            </div>

                            <div class="quantity d-flex flex-column flex-sm-row align-items-sm-center">
                                
                                <span>Quantity:</span>
                                <div class="quantity_selector">
                                    <span class="minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                    <span id="quantity_value">1</span>
                                    <span class="plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                </div>

                                <div class=" buy_now_button"><a href="#" style="color:white">Buy Now </a></div>
                                <div class="red_button add_to_cart_button"><a href="{{ route('frontend.add.to.cart', $singleProduct->id) }}">add to cart</a></div>
                                <div class="product_favorite d-flex flex-column align-items-center justify-content-center">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Tabs -->

            <div class="tabs_section_container">

                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="tabs_container">
                                <ul
                                    class="tabs d-flex flex-sm-row flex-column align-items-left align-items-md-center justify-content-center">
                                    <li class="tab active" data-active-tab="tab_1"><span>Description</span></li>
                                    <li class="tab" data-active-tab="tab_2"><span>Additional Information</span></li>
                                    <li class="tab" data-active-tab="tab_3"><span>Reviews (2)</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">

                            <!-- Tab Description -->

                            <div id="tab_1" class="tab_container active">
                                <div class="row">
                                    <div class="col-lg-5 desc_col">
                                        <div class="tab_title">
                                            <h4>Description</h4>
                                        </div>
                                        <div class="tab_text_block">
                                            <p>{{$singleProduct->product_description}}</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tab Additional Info -->
                                <div id="tab_2" class="tab_container">
                                    <div class="row">
                                        <div class="col additional_info_col">
                                            <div class="tab_title additional_info_title">
                                                <h4>Additional Information</h4>
                                            </div>
                                            <p>COLOR:<span>Gold, Red</span></p>
                                            <p>SIZE:<span>L,M,XL</span></p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tab Reviews -->
                                <div id="tab_3" class="tab_container">
                                    <div class="row">

                                        <!-- User Reviews -->

                                        <div class="col-lg-6 reviews_col">
                                            <div class="tab_title reviews_title">
                                                <h4>Reviews (2)</h4>
                                            </div>

                                            <!-- User Review -->

                                            <div class="user_review_container d-flex flex-column flex-sm-row">
                                                <div class="user">
                                                    <div class="user_pic"></div>
                                                    <div class="user_rating">
                                                        <ul class="star_rating">
                                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                            <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="review">
                                                    <div class="review_date">27 Aug 2016</div>
                                                    <div class="user_name">Brandon William</div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                        tempor incididunt ut labore et dolore magna aliqua.</p>
                                                </div>
                                            </div>

                                            <!-- User Review -->

                                            <div class="user_review_container d-flex flex-column flex-sm-row">
                                                <div class="user">
                                                    <div class="user_pic"></div>
                                                    <div class="user_rating">
                                                        <ul class="star_rating">
                                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                            <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="review">
                                                    <div class="review_date">27 Aug 2016</div>
                                                    <div class="user_name">Brandon William</div>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                        tempor incididunt ut labore et dolore magna aliqua.</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Add Review -->

                                        <div class="col-lg-6 add_review_col">

                                            <div class="add_review">
                                                <form id="review_form" action="post">
                                                    <div>
                                                        <h1>Add Review</h1>
                                                        <input id="review_name" class="form_input input_name" type="text"
                                                            name="name" placeholder="Name*" required="required"
                                                            data-error="Name is required.">
                                                        <input id="review_email" class="form_input input_email"
                                                            type="email" name="email" placeholder="Email*"
                                                            required="required" data-error="Valid email is required.">
                                                    </div>
                                                    <div>
                                                        <h1>Your Rating:</h1>
                                                        <ul class="user_star_rating">
                                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                            <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                            <li><i class="fa fa-star-o" aria-hidden="true"></i></li>
                                                        </ul>
                                                        <textarea id="review_message" class="input_review" name="message" placeholder="Your Review" rows="4" required
                                                            data-error="Please, leave us a review."></textarea>
                                                    </div>
                                                    <div class="text-left text-sm-right">
                                                        <button id="review_submit" type="submit"
                                                            class="red_button review_submit_btn trans_300"
                                                            value="Submit">submit</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>


                @include('frontend.partial.footer')

            </div>

            <script src="{{ url('frontend/js/jquery-3.2.1.min.js') }}"></script>
            <script src="{{ url('frontend/styles/bootstrap4/popper.js') }}"></script>
            <script src="{{ url('frontend/styles/bootstrap4/bootstrap.min.js') }}"></script>
            <script src="{{ url('frontend/plugins/Isotope/isotope.pkgd.min.js') }}"></script>
            <script src="{{ url('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
            <script src="{{ url('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
            <script src="{{ url('frontend/plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>
            <script src="{{ url('frontend/js/single_custom.js') }}"></script>

            @include('notify::components.notify')
            @notifyJs
</body>

</html>