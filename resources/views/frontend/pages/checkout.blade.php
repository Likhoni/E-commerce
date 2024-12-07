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
            width: 100px;
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

        <form action="{{ route('order.place') }}" method="post">
            @csrf
            <div class="container product_section_container">
                <div class="row" style="padding-top:180px;">

                    <div class="col-md-7">
                        <!-- Left Side: Shipping Address -->
                        <div class="left-section">
                            <h2>Shipping Address</h2>
                            <input name="status" class="form-control" type="hidden">
                            <div class="form-group">
                                <label><strong>First Name *</strong></label>
                                <input class="form-control" name="first_name" type="text" placeholder="First Name" required>
                            </div>

                            <div class="form-group">
                                <label><strong>Last Name *</strong></label>
                                <input class="form-control" name="last_name" type="text" placeholder="Last Name" required>
                            </div>
                            <div class="form-group">
                                <label><strong>Email *</strong></label>
                                <input class="form-control" name="email" type="email" placeholder="email">
                            </div>
                            <div class="form-group">
                                <label><strong>Contact Number *</strong></label>
                                <input class="form-control" name="contact_number" type="tel" placeholder="Mobile Number" required>
                            </div>
                            <div class="form-group">
                                <label><strong>Country</strong></label>
                                <input name="country" class="form-control" type="text" value="Bangladesh" readonly>
                            </div>
                            <div class="form-group">
                                <label><strong>Division *</strong></label>
                                <select name="division_id" id="division" class="form-control" required onchange="updateDistricts()">
                                    <option value="">Select Division</option>
                                    @foreach($divisions as $data)
                                    <option value="{{ $data->id }}">{{ strtoupper($data->name) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label><strong>District/City *</strong></label>
                                <select name="district_id" id="district" class="form-control" required onchange="updateUpazilas()">
                                    <option value="">Select Division First</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label><strong>Upazilla *</strong></label>
                                <select name="upazila_id" id="area" class="form-control" required onchange="updateUnions()">
                                    <option value="">Select District First</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label><strong>Union *</strong></label>
                                <select name="union_id" id="union" class="form-control" required>
                                    <option value="">Select Upazilla First</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label><strong>Address *</strong></label>
                                <input name="address" class="form-control" type="text" placeholder="House / Building / Street" required>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Your Bill and Payment Options -->
                    <div class="col-md-5">
                        <div class="right-section">
                            <!-- Order Summary Section -->
                            <div class="summary-box">
                                <h3>Your Order</h3>
                                <hr>
                                <div class="d-flex justify-content-between" style="font-size: large;">
                                    <strong>Selected Product ({{ $cartSummary['item_count'] }} item)</strong>
                                    <strong>Sub-Total</strong>
                                </div>
                                <hr>
                                @foreach ($myCart as $cartData)
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div>
                                        <span>{{ $cartData['product_name'] }} (x {{ $cartData['quantity'] }})</span>
                                        <input type="hidden" value="{{ $cartData['product_name'] }}" name="product_name[]">
                                    </div>
                                    <div>
                                        <span>
                                            ৳ {{ $cartData['product_price'] * $cartData['quantity'] }}
                                            <input type="hidden" value="{{ $cartData['quantity'] }}" name="quantity[]">
                                            <input type="hidden" value="{{ $cartData['product_price'] }}" name="product_price[]">
                                        </span>
                                    </div>
                                </div>
                                @endforeach


                                <hr>
                                <div class="d-flex justify-content-between">
                                    <h5>Sub-Total</h5>
                                    <h5>৳ {{ $cartSummary['subtotal'] }}</h5>
                                    <input type="hidden" name="cart_subtotal" value="{{ $cartSummary['subtotal'] }}">
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h5>Discount</h5>
                                    <h5>৳ {{ $cartSummary['discount'] }}</h5>
                                    <input type="hidden" name="cart_discount" value="{{ $cartSummary['discount'] }}">
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <h5>Total Price</h5>
                                    <h5>৳ {{ $cartSummary['total'] }}</h5>
                                    <input type="hidden" name="cart_total" value="{{ $cartSummary['total'] }}">
                                </div>
                            </div>

                            <!-- Payment Method Section -->
                            <div class="summary-box">
                                <h4>Select Payment Method</h4>
                                <div class="payment-options">
                                    <label class="payment-option">
                                        <input type="radio" name="payment_method" value="cash_on_delivery" required>
                                        <span>Cash on Delivery</span>
                                    </label>
                                    <label class="payment-option">
                                        <input type="radio" name="payment_method" value="sslcommerz" required>
                                        <span>Pay Online (Credit/Debit Card/Mobile or NetBanking/Nagad)</span>
                                        <img src="{{ url('/payment_logo/sslcz-verified.webp') }}" alt="SSLCommerz Verified" class="payment-logo-ssl">
                                    </label>
                                    <label class="payment-option">
                                        <input type="radio" name="payment_method" value="bkash" required>
                                        <span>BKash Payment Gateway</span>
                                        <img src="{{ url('/payment_logo/bkash.webp') }}" alt="bKash Logo" class="payment-logo">
                                    </label>
                                    <label class="payment-option">
                                        <input type="radio" name="payment_method" value="nagad" required>
                                        <span>Nagad Payment Gateway</span>
                                        <img src="{{ url('/payment_logo/nagad.webp') }}" alt="nagad Logo" class="payment-logo">
                                    </label>
                                    <label class="payment-option">
                                        <input type="radio" name="payment_method" value="ebl_skypay" required>
                                        <span>EBL Skypay</span>
                                        <div class="payment-logos">
                                            <img src="{{ url('/payment_logo/visa.svg') }}" alt="Visa" class="payment-logo-ebl">
                                            <img src="{{ url('/payment_logo/mastercard.svg') }}" alt="Mastercard" class="payment-logo-ebl">
                                            <img src="{{ url('/payment_logo/discover.svg') }}" alt="Discover" class="payment-logo-ebl">
                                            <img src="{{ url('/payment_logo/amex.svg') }}" alt="Amex" class="payment-logo-ebl">
                                            <img src="{{ url('/payment_logo/jcb.svg') }}" alt="JCB" class="payment-logo-ebl">
                                        </div>
                                        <p class="payment-description">Pay via CyberSource Secure Acceptance.</p>
                                    </label>
                                </div>
                            </div>



                            <!-- Submit Button -->
                            <div class="d-flex justify-content-center mt-3">
                                <button type="submit" class="btn btn-lg" style="background-color: LightSeaGreen; color: white;">
                                    Proceed to Payment
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>

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


    <script>
        // Pass the districts grouped by division from PHP to JS
        const districtsByDivision = @json($districts);
        const upazilasByDistrict = @json($upazilas);
        const unionsByUpazilla = @json($unions);

        // Function to update the district dropdown when a division is selected
        function updateDistricts() {
            const divisionId = document.getElementById("division").value;
            const districtSelect = document.getElementById("district");
            const areaSelect = document.getElementById("area");

            // Clear previous options
            districtSelect.innerHTML = '<option value="">Select District/City</option>';
            areaSelect.innerHTML = '<option value="">Select Area/Thana/Upazila</option>';

            // If a division is selected, populate the district dropdown
            if (divisionId && districtsByDivision[divisionId]) {
                const districts = districtsByDivision[divisionId];
                districts.forEach(district => {
                    const option = document.createElement("option");
                    option.value = district.id;
                    option.textContent = district.name;
                    districtSelect.appendChild(option);
                });
            } else {
                // If no division is selected, show the default "Select Division" text
                districtSelect.innerHTML = '<option value="">Select Division First</option>';
            }

            // Trigger update of upazilas (areas) based on the selected district
            updateUpazilas();
        }

        // Function to update upazilas (areas) when a district is selected
        function updateUpazilas() {
            const districtId = document.getElementById("district").value;
            const areaSelect = document.getElementById("area");

            // Clear previous options
            areaSelect.innerHTML = '<option value="">Select Area/Thana/Upazila</option>';

            // If a district is selected, populate the area dropdown
            if (districtId && upazilasByDistrict[districtId]) {
                const upazilas = upazilasByDistrict[districtId];
                upazilas.forEach(upazila => {
                    const option = document.createElement("option");
                    option.value = upazila.id;
                    option.textContent = upazila.name;
                    areaSelect.appendChild(option);
                });
            } else {
                // If no district is selected, show the default "Select District First" text
                areaSelect.innerHTML = '<option value="">Select District First</option>';
            }
        }

        function updateUnions() {
            const upazillaId = document.getElementById("area").value; // The upazilla dropdown
            const unionSelect = document.getElementById("union"); // The union dropdown

            // Clear previous options
            unionSelect.innerHTML = '<option value="">Select Union</option>';

            // If an upazilla is selected, populate the union dropdown
            if (upazillaId && unionsByUpazilla[upazillaId]) {
                const unions = unionsByUpazilla[upazillaId];
                unions.forEach(union => {
                    const option = document.createElement("option");
                    option.value = union.id;
                    option.textContent = union.name;
                    unionSelect.appendChild(option);
                });
            } else {
                // If no upazilla is selected, show the default "Select Upazilla First" text
                unionSelect.innerHTML = '<option value="">Select Upazilla First</option>';
            }
        }
    </script>


</body>

</html>