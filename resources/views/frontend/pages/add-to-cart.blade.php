@extends('frontend.master')
@section('content')
    <style>
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
    </style>

    <div style="padding-top:150px; padding-bottom:200px;">
        <section class="h-100 h-custom">
            <div>
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12">
                        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                            <div class="card-body p-0">
                                <div class="row g-0">
                                    <div class="col-lg-8">
                                        <div class="p-5">
                                            <div class="d-flex justify-content-between align-items-center mb-5">
                                                <h1 class="fw-bold mb-0">Shopping Cart</h1>
                                                <h6 class="mb-0 text-muted">3 items</h6>
                                            </div>
                                            <a href="{{ route('frontend.cart.clear') }}" class="btn btn-danger">Clear All
                                                Product</a>
                                            <hr class="my-4">


                                            @if (count($myCart) > 0)
                                                @foreach ($myCart as $cartData)
                                                    <div class="row mb-4 d-flex justify-content-between align-items-center">
                                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                                            <img src="{{ url('/images/products/' . $cartData['image']) }}"
                                                                class="img-fluid rounded-3" alt="Cotton T-shirt">
                                                        </div>

                                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                                            <h4 class="">{{ $cartData['product_name'] }}</h4>
                                                        </div>

                                                        <div class="col-md-3 col-lg-3 col-xl-2 d-flex align-items-center">
                                                            <form
                                                                action="{{ route('frontend.update.cart', $cartData['product_id']) }}"
                                                                method="post" class="d-flex align-items-center">
                                                                @csrf
                                                                <button style="color:black" type="button"
                                                                    class="btn btn-link btn-link-no-underline px-2"
                                                                    onclick="this.nextElementSibling.stepDown(); this.form.submit()">-</button>
                                                                <input id="form1" min="0" name="quantity"
                                                                    value="{{ session('basket')[$cartData['product_id']]['quantity'] ?? 1 }}" type="number"
                                                                    class="form-control form-control-sm text-center"
                                                                    style="width: 50px;" />
                                                                <button style="color:black" type="button"
                                                                    class="btn btn-link btn-link-no-underline px-2"
                                                                    onclick="this.previousElementSibling.stepUp(); this.form.submit()">+</button>
                                                            </form>
                                                        </div>

                                                        <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                            <h6 class="mb-0">{{ $cartData['subtotal'] }}</h6>
                                                        </div>

                                                        <div class="col-md-1 col-lg-1 col-xl-2 text-end">
                                                            <a href="{{ route('frontend.cart.item.delete', $cartData['product_id']) }}"
                                                                style="color:red;">
                                                                Delete
                                                            </a>
                                                        </div>

                                                    </div>
                                                @endforeach
                                            @else
                                                <p>Your Cart is Empty</p>
                                            @endif


                                            <hr class="my-4">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 bg-body-tertiary">
                                        <div class="p-5">
                                            <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                            <hr class="my-4">

                                            <div class="d-flex justify-content-between mb-4">
                                                <h5 class="text-uppercase">items 3</h5>
                                                <h5>€ 132.00</h5>
                                            </div>

                                            <h5 class="text-uppercase mb-3">Shipping</h5>

                                            <div class="mb-4 pb-2">
                                                <select data-mdb-select-init>
                                                    <option value="1">Standard-Delivery- €5.00</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                    <option value="4">Four</option>
                                                </select>
                                            </div>

                                            <h5 class="text-uppercase mb-3">Give code</h5>

                                            <div class="mb-5">
                                                <div data-mdb-input-init class="form-outline">
                                                    <input type="text" id="form3Examplea2"
                                                        class="form-control form-control-lg" />
                                                    <label class="form-label" for="form3Examplea2">Enter your code</label>
                                                </div>
                                            </div>

                                            <hr class="my-4">

                                            <div class="d-flex justify-content-between mb-5">
                                                <h5 class="text-uppercase">Total price</h5>
                                                <h5>€ 137.00</h5>
                                            </div>

                                            <button type="button" data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-dark btn-block btn-lg"
                                                data-mdb-ripple-color="dark">Register</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
