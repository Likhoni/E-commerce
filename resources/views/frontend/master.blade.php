<!DOCTYPE html>
<html lang="en">

<head>
    <style type="text/css">
        .notify {
            z-index: 1000000;
            margin-top: 5%;
        }

        .add-to-cart-btn {
            background-color: #B22222;
            /* Darker shade */
            color: white;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .add-to-cart-btn:hover {
            background-color: #E04C4C;
            /* Lighter shade on hover */
        }

        .cart-button {
            margin-left: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .add-to-cart-btn {
            background-color: #E04C4C;
            /* Slightly darker shade */
            color: white;
            padding: 10px 20px;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-to-cart-btn:hover {
            background-color: #FF5C5C;
            /* Lighter color on hover */
        }
    </style>
    @notifyCss
    <title>E-Commerce</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Colo Shop Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ url('frontend/plugins/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet"
        type="text/css">

    <link rel="stylesheet" href="{{ url('frontend/plugins/themify-icons/themify-icons.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ url('frontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/plugins/OwlCarousel2-2.2.1/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/plugins/jquery-ui-1.12.1.custom/jquery-ui.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('frontend/styles/bootstrap4/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/styles/responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/styles/contact_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/styles/contact_responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/styles/categories_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/styles/categories_responsive.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/styles/single_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('frontend/styles/single_responsive.css') }}">


</head>

<body>

    <div class="super_container">

        @include('frontend.partial.header')

        @yield('content')

        @include('frontend.partial.footer')

    </div>

    <script src="{{ url('frontend/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ url('frontend/js/custom.js') }}"></script>
    <script src="{{ url('frontend/js/single_custom.js') }}"></script>

    <script src="{{ url('frontend/styles/bootstrap4/popper.js') }}"></script>
    <script src="{{ url('frontend/styles/bootstrap4/bootstrap.min.js') }}"></script>

    <script src="{{ url('frontend/plugins/Isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ url('frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
    <script src="{{ url('frontend/plugins/easing/easing.js') }}"></script>
    <script src="{{ url('frontend/plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}"></script>

    <script src="{{ url('frontend/js/categories_custom.js') }}"></script>

    @include('notify::components.notify')
    @notifyJs

</body>

</html>
