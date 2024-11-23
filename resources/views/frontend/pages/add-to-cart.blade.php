<!DOCTYPE html>
<html lang="en">

<head>
    <style type="text/css">
        .notify {
            z-index: 1000000;
            margin-top: 5%;
        }

        .card-registration-2 {
            padding: 50px;
            border-radius: 15px;
        }

        .left-section,
        .right-section {
            border-radius: 15px;
            background-color: #f8f9fa;
            padding: 10px;
        }

        .summary-box {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 15px;
            margin-bottom: 20px;
        }

        .summary-box h5,
        .summary-box h3 {
            color: #333;
        }

        .payment-options {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-top: 20px;
        }

        .payment-option {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .payment-option:hover {
            border-color: #888;
        }

        .payment-option input[type="radio"] {
            appearance: none;
            width: 18px;
            height: 18px;
            cursor: pointer;
            margin-right: 1rem;
            border: 2px solid #333;
            border-radius: 4px;
            /* This controls the roundness; set to 0 for a perfect square */
            position: relative;
        }

        .payment-option input[type="radio"]:checked {
            background-color: #333;
            /* Color when selected */
        }

        .payment-option input[type="radio"]::before {
            content: "";
            width: 10px;
            height: 10px;
            position: absolute;
            top: 3px;
            left: 3px;
            background-color: white;
            display: none;
        }

        .payment-option input[type="radio"]:checked::before {
            display: block;
        }

        .payment-option span {
            font-size: 16px;
            font-weight: 500;
        }

        .payment-logos {
            display: flex;
            gap: 5px;
            margin-top: 5px;
        }

        .payment-logo-ebl {
            width: 40px;
            height: auto;
        }

        .payment-logo {
            width: 70px;
            height: auto;
        }

        .payment-logo-ssl {
            width: 90px;
            height: auto;
        }

        .payment-description {
            font-size: 14px;
            color: #666;
            margin-left: 2.5rem;
            margin-top: 4px;
        }

        .payment-description-container {
            margin-top: 10px;
        }

        .strikethrough-red {
            position: relative;
            color: black;
            display: inline-block;
        }

        .strikethrough-red::after {
            content: "";
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background-color: red;
            transform: rotate(-15deg);
            transform-origin: center;
        }

        /* Remove spinner buttons in number inputs */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
            /* For Firefox */
        }
    </style>
    @notifyCss

    <title>E-Commerce</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Colo Shop Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="{{ url('frontend/styles/bootstrap4/bootstrap.min.css') }}">
    <link href="{{ url('frontend/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/plugins/OwlCarousel2-2.2.1/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/styles/responsive.css') }}">
</head>

<body>
    <div class="super_container">
        @include('frontend.partial.header')
        <div class="container product_section_container">
            <div class="row" style="padding-top:180px;">
                <!-- Left Section: Cart Details -->
                <div class="col-md-8">
                    <div class="left-section">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h2 class="fw-bold mb-0">Shopping Cart</h2>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <h5 class="mb-0 text-muted"><strong>{{ count($myCart) }} items</strong></h5>
                            @if (count($myCart) > 0)
                            <a href="{{ route('frontend.cart.clear') }}" class="btn btn-danger">Clear All</a>
                            @endif
                        </div>

                        <hr class="my-4">

                        @if (count($myCart) > 0)
                        @foreach ($myCart as $cartData)
                        <div class="row mb-4 d-flex justify-content-between align-items-center">
                            <div class="col-md-2">
                                @if(!empty($cartData['image']))
                                <img style="height: 100px; width:100px" src="{{ url('/images/products/' .  $cartData['image']) }}" class="img-fluid rounded-3" alt="{{ $cartData['product_name'] }}">
                                @else
                                <img style="height: 100px; width:100px" src="{{ url('/images/products/default.png') }}" class="img-fluid rounded-3" alt="No image available">
                                @endif
                            </div>

                            <div class="col-md-2">
                                <h5>{{ $cartData['product_name'] }}</h5>
                            </div>

                            <div class="col-md-2 d-flex align-items-center">
                                <form action="{{ route('frontend.update.cart', $cartData['product_id']) }}" method="post" class="d-flex align-items-center">
                                    @csrf
                                    <button style="color:black; text-decoration: none;" type="button" class="btn btn-link px-2" onclick="if (this.nextElementSibling.value > 1) { this.nextElementSibling.stepDown(); this.form.submit(); }">-</button>
                                    <input id="form1" min="0" name="quantity" value="{{ session('basket')[$cartData['product_id']]['quantity'] ?? 1 }}" type="number" class="form-control form-control-sm text-center" style="width: 50px;" />
                                    <button style="color:black; text-decoration: none;" type="button" class="btn btn-link px-2" onclick="this.previousElementSibling.stepUp(); this.form.submit()">+</button>
                                </form>
                            </div>

                            <div class="col-md-4">
                                <h6 class="mb-0">
                                    Unit Price:
                                    <strong>
                                        @if(isset($cartData['discount_price']) && $cartData['discount_price'] > 0)
                                        ৳ {{ $cartData['discount_price'] }}
                                        <span class="strikethrough-red">৳ {{ $cartData['product_price'] }}</span>
                                        @else
                                        ৳ {{ $cartData['product_price'] }}
                                        @endif
                                    </strong>
                                </h6>
                                <h6 class="mb-0">
                                    Amount:
                                    <strong>
                                        ৳ {{ (isset($cartData['discount_price']) && $cartData['discount_price'] > 0 ? $cartData['discount_price'] : $cartData['product_price']) * (session('basket')[$cartData['product_id']]['quantity'] ?? 1) }}
                                    </strong>
                                </h6>
                            </div>

                            <div class="col-md-2 text-end">
                                <a href="{{ route('frontend.cart.item.delete', $cartData['product_id']) }}" style="color:red;">Delete</a>
                            </div>
                        </div>
                        <hr class="my-4">
                        @endforeach
                        @else
                        <p>Your Cart is Empty</p>
                        @endif
                    </div>
                </div>

                <!-- Right Section: Order Summary and Checkout -->
                <div class="col-md-4">
                    <div class="right-section">
                        <div class="summary-box">
                            <h3>Your Bill</h3>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <h5 class="">{{ count($myCart) }} item</h5>
                            </div>

                            <div class="d-flex justify-content-between">
                                <h5 class="text-uppercase">Sub-Total</h5>
                                <h5>৳ {{ $subtotal }}</h5>
                            </div>

                            <div class="d-flex justify-content-between">
                                <h5 class="text-uppercase">Discount</h5>
                                <h5>৳ {{ $discount }}</h5>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between">
                                <h5 class="text-uppercase">Total Price</h5>
                                <h5>৳ {{ $total }}</h5>
                            </div>
                        </div>

                        <a href="{{ route('checkout.cart') }}" class="btn btn-block btn-lg" style="background-color: LightSeaGreen; color: white;">Go to Checkout</a>
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
    <script src="{{ url('frontend/js/custom.js') }}"></script>


    @include('notify::components.notify')
    @notifyJs
</body>

</html>