@extends('frontend.master')
@section('content')
<div class="main_slider" style="background-image:url(frontend/images/slider_1.jpg)">
    <div class="container fill_height">
        <div class="row align-items-center" style="padding-top:50px">
            <div class="col">
                <div class="main_slider_content">

                    <div>
                        <h3>Enter OTP to verify your account.</h3>
                        <form action="{{route('otp.submit')}}" method="post">
                            @csrf

                            <input type="hidden" value="{{$email}}" name="email">
                            
                            <input type="number" id="otp" class="fadeIn second form-control" name="otp" placeholder="Enter OTP">

                            <a href="{{route('otp.resend',$email)}}">Resend OTP</a>
                            <input type="submit" class="btn btn-success active" style="margin: 5px;" value="Submit">
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection