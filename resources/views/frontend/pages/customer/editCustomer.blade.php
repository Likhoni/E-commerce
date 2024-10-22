@extends('frontend.master')
@section('content')
    <div class="main_slider" style="background-image:url(/frontend/images/slider_1.jpg)">
        <div class="container fill_height">
            <div class="row align-items-center" style="padding-top:50px">
                <div class="col">
                    <div class="main_slider_content">
                        <div>
                            <form action="{{ route('customer.update', $editCustomer->id) }}" method="post"
                                enctype="multipart/form-data"
                                style="border: 2px solid #000; border-radius: 10px; padding: 20px; max-width: 600px; margin: 0 auto; background-color: white;">
                                @method('put')
                                @csrf
                                <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                                    <!-- Left Column -->
                                    <div style="flex: 1;">

                                        <label for="name"
                                            style="color: black; margin-bottom: 5px; font-size: 16px; font-weight: bold;">
                                            Your First Name</label>
                                        <input type="text" id="name" name="first_name"
                                            value="{{ $editCustomer->first_name }}" placeholder="Your Name"
                                            style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px;">

                                        <label for="name"
                                            style="color: black; margin-bottom: 5px; font-size: 16px; font-weight: bold;">
                                            Your Last Name</label>
                                        <input type="text" id="name" name="last_name"
                                            value="{{ $editCustomer->last_name }}" placeholder="Your Name"
                                            style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px;">

                                        <label for="Phone Number"
                                            style="color: black; margin-bottom: 5px; font-size: 16px; font-weight: bold;">Phone
                                            Number</label>
                                        <input type="number" id="phone_number" name="phone_number"
                                            value="{{ $editCustomer->phone_number }}" placeholder="number"
                                            style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px;">
                                    </div>

                                    <!-- Right Column -->
                                    <div style="flex: 1;">
                                        <label for="email"
                                            style="color: black; margin-bottom: 5px; font-size: 16px; font-weight: bold;">Email</label>
                                        <input type="email" id="email" name="email"
                                            value="{{ $editCustomer->email }}" placeholder="Email"
                                            style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px;">

                                        <label for="address"
                                            style="color: black; margin-bottom: 5px; font-size: 16px; font-weight: bold;">Address</label>
                                        <input type="text" id="address" name="address"
                                            value="{{ $editCustomer->address }}" placeholder="Address"
                                            style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px;">

                                        <label for="file"
                                            style="color: black; margin-bottom: 5px; font-size: 16px; font-weight: bold;">
                                            Upload Your Image</label>
                                        <img style="width: 100px;height:100px"
                                            src="{{ url('images/customers', $editCustomer->image) }}" alt="">
                                        <input type="file" id="file" name="image"
                                            value="{{ $editCustomer->image }}"
                                            style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px;">
                                    </div>
                                </div>

                                <div style="margin-top: 20px; text-align: center;">
                                    <button type="submit"
                                        style="padding: 10px 20px; background-color: #e74c3c; color: white; text-transform: uppercase; text-decoration: none; border-radius: 5px; border: none;">
                                        Update
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
