<!DOCTYPE html>
<html lang="en">

<head>
    <style type="text/css">
        .notify {
            z-index: 1000000;
            margin-top: 5%;
        }

        @media (min-width: 1025px) {
            .h-custom {
                height: 100vh !important;
            }
        }

        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }

        .card-registration .select-arrow {
            top: 13px;
        }

        input[type="number"]::-webkit-outer-spin-button,
        input[type="number"]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

        /* Custom style to remove underline on hover */
        .btn-link-no-underline {
            text-decoration: none !important;
        }

        .strikethrough-red {
            position: relative;
            color: inherit;
            /* Keeps the text color the same */
        }

        .strikethrough-red::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            top: 50%;
            border-top: 3px solid red;
            transform: rotate(-10deg);
            /* Slight angle if desired */
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

        @yield('content')

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