@extends("backend.master")

@section('content')
<div style="padding: 20px;">

    <form action="{{route('admin.customer.update', $editCustomer->id)}}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h1><strong>Update Customer Form</strong></h1><br>


                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>First Name</strong></label>
                        <input required value="{{$editCustomer->first_name}}" name="first_name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Last Name</strong></label>
                        <input required value="{{$editCustomer->last_name}}" name="last_name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>E-Mail</strong></label>
                        <input required value="{{$editCustomer->email}}" name="email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Phone</strong></label>
                        <input required value="{{$editCustomer->phone_number}}" name="phone_number" type="tel" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong> Image </strong></label>
                        <input value="{{$editCustomer->image}}" name="customer_image" type="file" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Address</strong></label>
                        <input required value="{{$editCustomer->address}}" name="address" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div><br>


                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection