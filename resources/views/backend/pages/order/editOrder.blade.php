@extends('backend.master')

@section('content')
<div style="padding: 20px;">

    <form action="{{ route('order.update', $editOrder->id) }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h1><strong>Update Order Form</strong></h1><br>

                    <input required name="customer_id" type="hidden" class="form-control" id="exampleFormControlInput1"
                        value="{{ auth('customerGuard')->user()->id }}" placeholder="">

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Receiver Name</strong></label>
                        <input required name="receiver_name" type="text" class="form-control"
                            id="exampleFormControlInput1" value="{{$editOrder->receiver_name}}" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Receiver Email</strong></label>
                        <input required name="receiver_email" type="email" class="form-control"
                            id="exampleFormControlInput1" value="{{$editOrder->receiver_email}}" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Receiver Mobile</strong></label>
                        <input required name="receiver_mobile" type="tel" class="form-control"
                            id="exampleFormControlInput1" value="{{$editOrder->receiver_mobile}}" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="district">District/City *</label>
                        <select  name="district" class="form control" id="district" required>
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
                    </div><br>

                    <div class="form-group">
                        <label for="area">Area/Thana/Upazilla *</label>
                        <select name="thana" class="form control" id="area" required>
                            <option value="">Select Area/Thana/Upazilla</option>
                            <!-- Populate options based on selected district -->
                        </select>
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Receiver Address</strong></label>
                        <input required name="receiver_address" type="text" class="form-control"
                            id="exampleFormControlInput1" value="{{$editOrder->receiver_address}}" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Status</strong></label>
                        <select name="status" id="" class="form-control">
                            <option value="{{$editOrder->status}}">{{$editOrder->status}}</option>
                            <option value="pending">pending</option>
                            <option value="accept">accept</option>
                        </select>
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Payment Method</strong></label>
                        <input required name="payment_method" type="text" class="form-control"
                            id="exampleFormControlInput1" value="{{$editOrder->payment_method}}" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Payment Status</strong></label>
                        <select name="payment_status" id="" class="form-control">
                            <option value="{{$editOrder->payment_status}}">{{$editOrder->payment_status}}</option>
                            <option value="pending">pending</option>
                            <option value="accept">accept</option>
                        </select>
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Order Number</strong></label>
                        <input required name="order_number" type="text" class="form-control"
                            id="exampleFormControlInput1" value="{{$editOrder->order_number}}" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Total Amount</strong></label>
                        <input required name="total_amount" type="number" class="form-control"
                            id="exampleFormControlInput1" value="{{$editOrder->total_amount}}" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Total Discount</strong></label>
                        <input required name="total_discount" type="number" class="form-control"
                            id="exampleFormControlInput1" value="{{$editOrder->total_discount}}" placeholder="">
                    </div><br>


                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection