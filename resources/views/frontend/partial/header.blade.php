<header class="header trans_300">
    <style>
        .shop-by-category {
            position: relative;
            display: inline-block;
        }

        .category-toggle {
            background: none;
            border: none;
            font-size: 16px;
            cursor: pointer;
            color: black;
            display: flex;
            align-items: center;
        }

        .category-toggle i {
            margin-right: 8px;
        }

        .slider-menu {
            position: fixed;
            top: 0;
            left: -300px;
            /* Initially hidden off-screen */
            width: 300px;
            height: auto;
            background-color: #fff;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            transition: left 0.3s ease;
            z-index: 1000;
            padding: 20px;
            display: none;
            /* Hidden by default */
        }

        .slider-menu.active {
            display: block;
            /* Show when active */
            left: 0;
            /* Slides in */
        }

        .slider-menu ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .slider-menu li {
            padding: 10px 0;
            font-size: 16px;
            border-bottom: 1px solid #f2f2f2;
        }

        .slider-menu li:hover {
            padding: 20px;
        }

        ul,
        #myUL {
            list-style-type: none;
        }

        #myUL {
            margin: 0;
            padding: 0;
        }

        .caret {
            cursor: pointer;
            -webkit-user-select: none;
            /* Safari 3.1+ */
            -moz-user-select: none;
            /* Firefox 2+ */
            -ms-user-select: none;
            /* IE 10+ */
            user-select: none;
        }

        .caret::before {
            content: "\25B6";
            color: black;
            display: inline-block;
            margin-right: 6px;
        }

        .caret-down::before {
            -ms-transform: rotate(90deg);
            /* IE 9 */
            -webkit-transform: rotate(90deg);
            /* Safari */
            transform: rotate(90deg);
        }

        .nested {
            display: none;
        }

        .active {
            display: block;
        }
    </style>
    <!-- Top Navigation -->
    <div class="top_nav">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="logo_container">
                        <a href="#" style="color: #f2f2f2;">E - <span>COMMERCE</span></a>
                    </div>
                </div>
                <div class="col-md-6 text-right">
                    <div class="top_nav_right">
                        <ul class="top_nav_menu">

                            <!-- Currency / Language / My Account -->

                            <li class="currency">
                                <a href="#">
                                    Currency
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="currency_selection">
                                    <li><a href="#">euro</a></li>
                                    <li><a href="#">usd</a></li>
                                    <li><a href="#">taka</a></li>
                                </ul>
                            </li>

                            <li class="language">
                                <a href="">Language
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="language_selection">
                                    <li><a href="{{ route('change.language', 'bn') }}">Bangla</a></li>
                                    <li><a href="{{ route('change.language', 'en') }}">English</a></li>
                                </ul>
                            </li>

                            <li class="account">
                                @guest('customerGuard')
                                <a href="#">
                                    Add Account
                                    <i class="fa fa-angle-down"></i>
                                </a>
                                @endguest

                                @auth('customerGuard')
                                <a href="#" style="display: flex; align-items: center;">
                                    @if (auth('customerGuard')->user()->image)
                                    <img src="{{ url('images/customers/', auth('customerGuard')->user()->image) }}"
                                        alt="profile picture" class="profile-img"
                                        style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-top: 5px;">
                                    @else
                                    <i class="fa fa-user" aria-hidden="true"
                                        style="font-size: 40px; margin-top: 5px;"></i>
                                    @endif
                                    <span style="margin-left: 10px;">
                                        {{ auth('customerGuard')->user()->FullName }}

                                    </span>
                                    <i class="fa fa-angle-down" style="margin-left: 5px;"></i>
                                </a>
                                @endauth

                                <ul class="account_selection">
                                    @guest('customerGuard')
                                    <li><a href="{{ route('frontend.sign.up') }}"><i class="fa fa-user-plus"
                                                aria-hidden="true"></i>Sign Up</a></li>
                                    <li><a href="{{ route('frontend.sign.in') }}"><i class="fa fa-sign-in"
                                                aria-hidden="true"></i>Sign In</a></li>
                                    @endguest

                                    @auth('customerGuard')
                                    <li><a href="{{ route('customer.view') }}">
                                            <i class="fa fa-user" aria-hidden="true"></i>View Profile</a>
                                    </li>
                                    <li><a href="{{ route('frontend.sign.out') }}"><i class="fa fa-sign-out"
                                                aria-hidden="true"></i>Sign Out</a></li>
                                    @endauth
                                </ul>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <div class="main_nav_container">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-right">
                    <div class="logo_container">
                        <div class="shop-by-category">
                            <button class="category-toggle">
                                <i class="fa fa-bars"></i> Shop By Category
                            </button>
                            <div class="slider-menu">
                                @foreach($parents as $parent)
                                <ul id="myUL">
                                    <li>{{$parent->category_name}} <span class="caret"></span>
                                        @if(count($parent->child)>0)
                                        @include('frontend.partial.child', ['parent'=>$parent])
                                        @endif
                                    </li>
                                </ul>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <nav class="navbar">
                        <ul class="navbar_menu">
                            <li><a href="{{ route('frontend.homepage') }}">{{ __('Home') }}</a></li>
                            <li><a href="{{ route('frontend.all.category.products') }}">Category</a></li>
                            {{-- <li><a href="{{route('frontend.all.brand.products')}}">Brand</a></li> --}}
                            <li><a href="#">pages</a></li>
                            <li><a href="#">blog</a></li>
                            <li><a href="{{ route('frontend.contact.us') }}">contact</a></li>
                        </ul>

                        <!--Add to Cart  & Search-->
                        <ul class="navbar_user">
                            <li><a href="#"><i class="fa fa-search" aria-hidden="true"></i></a></li>

                            <li class="checkout">
                                <a href="{{ route('frontend.view.cart') }}">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="checkout_items" class="checkout_items">
                                        @php
                                        if (session()->has('basket')) {
                                        echo count(session()->get('basket'));
                                        } else {
                                        echo 0;
                                        }
                                        @endphp
                                    </span>
                                </a>
                            </li>
                        </ul>

                        <div class="hamburger_container">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('.category-toggle').addEventListener('click', function(e) {
            e.stopPropagation(); // Prevent this click from propagating to the document
            const sliderMenu = document.querySelector('.slider-menu');

            if (sliderMenu.classList.contains('active')) {
                sliderMenu.classList.remove('active');
            } else {
                sliderMenu.classList.add('active');
            }
        });

        document.addEventListener('click', function(e) {
            const sliderMenu = document.querySelector('.slider-menu');
            const button = document.querySelector('.category-toggle');

            if (!sliderMenu.contains(e.target) && !button.contains(e.target)) {
                sliderMenu.classList.remove('active');
            }
        });
    </script>

    <script>
        var toggler = document.getElementsByClassName("caret");
        var i;

        for (i = 0; i < toggler.length; i++) {
            toggler[i].addEventListener("click", function() {
                this.parentElement.querySelector(".nested").classList.toggle("active");
                this.classList.toggle("caret-down");
            });
        }
    </script>

</header>