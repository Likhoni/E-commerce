@extends('frontend.master')
@section('content')

<div style="padding-top:180px; padding-left:20px;">
    <section class="h-100 h-custom">
        <form action="{{route('order.place')}}" method="post">
            @csrf
            <div>
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-12">
                        <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                            <div class="card-body p-0">
                                <!-- Left Side: Shipping Address -->
                                <div class="row g-0">
                                    <div class="col-lg-9">
                                        <h2>Shipping Address</h2>
                                        
                                        <div class="form-group"><!-- For Customer ID-->
                                            <input name="status" class="form-control" type="hidden" id="address" placeholder="">
                                        </div>

                                        <div class="form-group">
                                            <label for="recipient-name"><strong>Recipient Name *</strong></label>
                                            <input class="form-control" name="name" type="text" id="recipient-name" placeholder="Full Name" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="email"><strong>Email * </strong></label>
                                            <input class="form-control" name="email" type="email" id="contact-number" placeholder="email">
                                        </div>

                                        <div class="form-group">
                                            <label for="contact-number"><strong>Contact Number * </strong></label>
                                            <input class="form-control" name="number" type="tel" id="contact-number" placeholder="Mobile Number" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="country"><strong>Country</strong></label>
                                            <input name="country" class="form-control" type="text" id="country" value="Bangladesh" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="district"><strong>District/City *</strong></label>
                                            <select name="district_id" class="form-control" id="district" required onchange="updateUpazilas()">
                                                <option value="">Select District/City</option>
                                                @foreach($districts as $data)
                                                <option value="{{ $data->id }}">{{ strtoupper($data->name) }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="area"><strong>Area/Thana/Upazilla *</strong></label>
                                            <select name="thana" class="form-control" id="area" required>
                                                <option value="">Select District First</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="address"><strong>Address *</strong></label>
                                            <input name="address" class="form-control" type="text" id="address" placeholder="House / Building / Street" required>
                                        </div>

                                    </div>

                                    <!-- Right Side: Your Bill -->
                                    <div class="col-lg-3 bg-body-tertiary border rounded" style="border-color: #ddd; border-width: 1px; border-radius: 15px;">
                                        <div class="p-5">
                                            <h3 class="fw-bold mb-5 mt-2 pt-1">Your Bill</h3>
                                            <hr class="my-4">

                                            <div class="d-flex justify-content-between mb-4">
                                                <h5 class="text-uppercase"></h5>
                                            </div>

                                            <div class="d-flex justify-content-between mb-4">
                                                <h5 class="text-uppercase mb-3">Sub-Total</h5>
                                                <h5>৳ </h5>
                                            </div>

                                            <div class="d-flex justify-content-between mb-4">
                                                <h5 class="text-uppercase mb-3">Discount</h5>
                                                <h5>৳ </h5>
                                            </div>

                                            <hr class="my-4">
                                            <div class="d-flex justify-content-between mb-5">
                                                <h5 class="text-uppercase">Total price</h5>
                                                <h5>৳ </h5>
                                            </div>

                                            <button type="submit" class="btn btn-block btn-lg"
                                                style="background-color: LightSeaGreen; color: white;">
                                                Proceed to Payment
                                            </button>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </section>
</div>
@endsection

<script>
    // Preload upazilas from PHP data
    const upazilas = @json($upazilas);

    function updateUpazilas() {
        // Get selected district ID
        const districtId = document.getElementById("district").value;
        const areaSelect = document.getElementById("area");

        // Clear previous options
        areaSelect.innerHTML = '<option value="">Select Area/Thana/Upazilla</option>';

        if (districtId && upazilas[districtId]) {
            // Populate upazilas specific to selected district
            upazilas[districtId].forEach(upazila => {
                const option = document.createElement("option");
                option.value = upazila.name;
                option.textContent = upazila.name;
                areaSelect.appendChild(option);
            });
        } else {
            // Show a default message if no district is selected
            areaSelect.innerHTML = '<option value="">Select District First</option>';
        }
    }
</script>