@extends('frontend.master')
@section('content')
    <div class="main_slider" style="background-image:url(frontend/images/slider_1.jpg)">
        <div class="container fill_height">
            <div class="row align-items-center" style="padding-top:50px">
                <div class="col">
                    <div class="main_slider_content">
                        <div>
                            <form action="" method=""
                                style="border: 2px solid #000; border-radius: 10px; padding: 20px; max-width: 600px; margin: 0 auto; background-color: white;">
                                <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                                    <!-- Left Column -->

                                    <!-- Right Column -->
                                    <div style="flex: 1;">
                                        <label for="email"
                                            style="color: black; margin-bottom: 5px; font-size: 16px; font-weight: bold;">Email</label>
                                        <input type="email" id="email" name="email" value=""
                                            placeholder="Email"
                                            style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px;">                                       
                                        <label for="password"
                                            style="color: black; margin-bottom: 5px; font-size: 16px; font-weight: bold;">Password</label>
                                        <input type="password" id="password" name="password" value=""
                                            placeholder="Password"
                                            style="width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px;">
                                    </div>
                                </div>
                                <div style="margin-top: 20px; text-align: center;">
                                    <button type="submit"
                                        style="padding: 10px 20px; background-color: #e74c3c; color: white; text-transform: uppercase; text-decoration: none; border-radius: 5px; border: none;">
                                        Log In
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
