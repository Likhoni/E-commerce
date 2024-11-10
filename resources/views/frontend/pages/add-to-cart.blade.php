@extends('frontend.master')
@section('content')

<div style="padding-top:150px;">
    <section class="h-100 h-custom">
        <div>
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-lg-9">
                                    <div class="p-5">

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
                                                <img style="height: 100px; width:100px" src="{{ url('/images/products/' . $cartData['image']) }}"
                                                    class="img-fluid rounded-3" alt="Cotton T-shirt">
                                            </div>

                                            <div class="col-md-2">
                                                <h5 class="">{{ $cartData['product_name'] }}</h5>
                                            </div>

                                            <div class="col-md-2 d-flex align-items-center">
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
                                                <a href="{{ route('frontend.cart.item.delete', $cartData['product_id']) }}"
                                                    style="color:red;">
                                                    Delete
                                                </a>
                                            </div>

                                        </div>
                                        <hr class="my-4">
                                        @endforeach
                                        @else
                                        <p>Your Cart is Empty</p>
                                        @endif


                                    </div>
                                </div>

                                <div class="col-lg-3 bg-body-tertiary border rounded" style="border-color: #ddd; border-width: 1px; border-radius: 15px;">
                                    <div class="p-5">
                                        <h3 class="fw-bold mb-5 mt-2 pt-1">Your Bill</h3>
                                        <hr class="my-4">

                                        <div class="d-flex justify-content-between mb-4">
                                            <h5 class="text-uppercase">{{ count($myCart) }} (items)</h5>
                                        </div>

                                        <div class="d-flex justify-content-between mb-4">
                                            <h5 class="text-uppercase mb-3">Sub-Total</h5>
                                            <h5>৳ {{ count($myCart) > 0 ? $cartData['subtotal'] : 0 }}</h5>
                                        </div>

                                        <div class="d-flex justify-content-between mb-4">
                                            <h5 class="text-uppercase mb-3">Discount</h5>
                                            <h5>৳ {{ count($myCart) > 0 ? $cartData['subtotal'] : 0 }}</h5>
                                        </div>

                                        <hr class="my-4">
                                        <div class="d-flex justify-content-between mb-5">
                                            <h5 class="text-uppercase">Total price</h5>
                                            <h5>৳ {{ count($myCart) > 0 ? $cartData['subtotal'] : 0 }}</h5>
                                        </div>

                                        <a href="{{ route('checkout.cart') }}" class="btn btn-block btn-lg"
                                            style="background-color: LightSeaGreen; color: white;">
                                            Go to Checkout
                                        </a>



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