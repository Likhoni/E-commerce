<!DOCTYPE html>
<html lang="en">

<head>
    <style type="text/css">
        .notify {
            z-index: 1000000;
            margin-top: 5%;
        }

        .sidebar_categories .active {
            color: #ff6f61;
            font-weight: bold;
        }

        .hidden {
            display: none;
        }

        .sidebar_categories .icon {
            display: none;
        }

        .sidebar_categories .active .icon {
            display: inline;
        }

        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px; /* Optional spacing */
        }

        .product-item {
            width: calc(25% - 10px); /* 4 items per row, with gap */
            max-width: 200px; /* Adjust as per your layout requirements */
            position: relative; /* For pseudo-elements */
        }

        .product-item::after {
            display: block;
            position: absolute;
            top: 0;
            left: -1px;
            width: calc(100% + 1px);
            height: 100%;
            pointer-events: none;
            content: '';
            border: solid 2px rgba(235, 235, 235, 0);
            border-radius: 3px;
            transition: all 0.3s ease;
        }
    </style>
    <title>E-Commerce</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Colo Shop Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{ url('frontend/styles/bootstrap4/bootstrap.min.css') }}">
    <link href="{{ url('frontend/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ url('frontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/plugins/OwlCarousel2-2.2.1/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/styles/categories_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/styles/categories_responsive.css') }}">
</head>

<body>

    <div class="super_container">

        <!-- Header -->
        @include('frontend.partial.header')

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
                                <li>
                                    <a href="javascript:void(0);" class="category-link active" data-category="all">
                                        <span class="icon"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>
                                        All
                                    </a>
                                </li>
                                @foreach ($categories as $data)
                                    <li>
                                        <a href="javascript:void(0);" class="category-link"
                                            data-category="{{ $data->id }}">
                                            <span class="icon hidden"><i class="fa fa-angle-double-right"
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
                                    <div class="product-container">
                                        @foreach ($products as $product)
                                            <div class="product-item" data-category="{{ $product->category_id }}">
                                                <div class="product product_filter">
                                                    <div class="product_image">
                                                        <img src="{{ url('images/products', $product->product_image) }}"
                                                            alt="">
                                                    </div>
                                                    <div class="product_info">
                                                        <h6 class="product_name">
                                                            <a href="single.html">{{ $product->product_name }}</a>
                                                        </h6>
                                                        <div class="product_price">TK.
                                                            {{ $product->product_price }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="red_button add_to_cart_button"><a href="{{route('frontend.add.to.cart')}}">add to
                                                        cart</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('frontend.partial.footer')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const categoryLinks = document.querySelectorAll('.category-link');
            const productItems = document.querySelectorAll('.product-item');

            // Show all products by default
            productItems.forEach(product => product.style.display = "block");

            // Category click event
            categoryLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent default link behavior
                    const category = this.getAttribute('data-category');

                    // Remove 'active' class from all links and hide icons
                    categoryLinks.forEach(link => {
                        link.classList.remove('active');
                        link.querySelector('.icon').classList.add('hidden');
                    });

                    // Set clicked link as active and show icon
                    this.classList.add('active');
                    this.querySelector('.icon').classList.remove('hidden');

                    // Show/hide products based on selected category
                    productItems.forEach(product => {
                        const productCategory = product.getAttribute('data-category');
                        if (category === 'all' || productCategory === category) {
                            product.style.display = "block"; // Show matching products
                        } else {
                            product.style.display =
                                "none"; // Completely hide non-matching products
                        }
                    });
                });
            });
        });
    </script>

    <script src="{{ url('frontend/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ url('frontend/styles/bootstrap4/popper.js') }}"></script>
    <script src="{{ url('frontend/styles/bootstrap4/bootstrap.min.js') }}"></script>
    <script src="{{ url('frontend/plugins/Isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ url('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
    <script src="{{ url('frontend/plugins/easing/easing.js') }}"></script>
    <script src="{{ url('frontend/plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>
    <script src="{{ url('frontend/js/categories_custom.js') }}"></script>
</body>

</html>
