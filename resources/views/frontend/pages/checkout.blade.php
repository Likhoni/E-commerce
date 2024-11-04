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
                                            <select name="district" class="form-control" id="district" required>
                                                <option value="">Select District/City</option>
                                                <option value="bagerhat">Bagerhat</option>
                                                <option value="bandarban">Bandarban</option>
                                                <option value="barguna">Barguna</option>
                                                <option value="barisal">Barisal</option>
                                                <option value="bhola">Bhola</option>
                                                <option value="bogura">Bogura</option>
                                                <option value="brahmanbaria">Brahmanbaria</option>
                                                <option value="chandpur">Chandpur</option>
                                                <option value="chattogram">Chattogram</option>
                                                <option value="chuadanga">Chuadanga</option>
                                                <option value="coxsbazar">Cox's Bazar</option>
                                                <option value="cumilla">Cumilla</option>
                                                <option value="dhaka">Dhaka</option>
                                                <option value="dinajpur">Dinajpur</option>
                                                <option value="faridpur">Faridpur</option>
                                                <option value="feni">Feni</option>
                                                <option value="gaibandha">Gaibandha</option>
                                                <option value="gazipur">Gazipur</option>
                                                <option value="gopalganj">Gopalganj</option>
                                                <option value="habiganj">Habiganj</option>
                                                <option value="jamalpur">Jamalpur</option>
                                                <option value="jashore">Jashore</option>
                                                <option value="jhenaidah">Jhenaidah</option>
                                                <option value="joypurhat">Joypurhat</option>
                                                <option value="khagrachari">Khagrachari</option>
                                                <option value="khulna">Khulna</option>
                                                <option value="kishoreganj">Kishoreganj</option>
                                                <option value="kurigram">Kurigram</option>
                                                <option value="kushtia">Kushtia</option>
                                                <option value="lakshmipur">Lakshmipur</option>
                                                <option value="lalmonirhat">Lalmonirhat</option>
                                                <option value="madaripur">Madaripur</option>
                                                <option value="magura">Magura</option>
                                                <option value="manikganj">Manikganj</option>
                                                <option value="meherpur">Meherpur</option>
                                                <option value="moulvibazar">Moulvibazar</option>
                                                <option value="munshiganj">Munshiganj</option>
                                                <option value="mymensingh">Mymensingh</option>
                                                <option value="naogaon">Naogaon</option>
                                                <option value="narail">Narail</option>
                                                <option value="narayanganj">Narayanganj</option>
                                                <option value="narsingdi">Narsingdi</option>
                                                <option value="natore">Natore</option>
                                                <option value="netrokona">Netrokona</option>
                                                <option value="nilphamari">Nilphamari</option>
                                                <option value="noakhali">Noakhali</option>
                                                <option value="pabna">Pabna</option>
                                                <option value="panchagarh">Panchagarh</option>
                                                <option value="patuakhali">Patuakhali</option>
                                                <option value="pirojpur">Pirojpur</option>
                                                <option value="rajbari">Rajbari</option>
                                                <option value="rajshahi">Rajshahi</option>
                                                <option value="rangamati">Rangamati</option>
                                                <option value="rangpur">Rangpur</option>
                                                <option value="satkhira">Satkhira</option>
                                                <option value="shariatpur">Shariatpur</option>
                                                <option value="sherpur">Sherpur</option>
                                                <option value="sirajganj">Sirajganj</option>
                                                <option value="sunamganj">Sunamganj</option>
                                                <option value="sylhet">Sylhet</option>
                                                <option value="tangail">Tangail</option>
                                                <option value="thakurgaon">Thakurgaon</option>

                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="area"><strong>Area/Thana/Upazilla * </strong></label>
                                            <select name="thana" class="form-control" id="area" required>
                                                <option value="">Select Area/Thana/Upazilla</option>
                                                <option value="barisal sadar">Barisal Sadar</option>
                                                <option value="dhaka sadar">Dhaka Sadar</option>
                                                <!-- Populate options based on selected district -->
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="address"><strong>Address *</strong></label>
                                            <input name="address" class="form-control" type="text" id="address" placeholder="House / Building / Street" required>
                                        </div>

                                        <div class="form-group">
                                            <input name="status"  class="form-control" type="hidden" id="address" placeholder="House / Building / Street" required>
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