@extends("backend.master")

@section('content')
<div style="padding: 20px;">

    <form action="{{route('admin.user.update', $editUser->id)}}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h1><strong>Update User Form</strong></h1><br>


                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>First Name</strong></label>
                        <input required value="{{$editUser->first_name}}" name="first_name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Last Name</strong></label>
                        <input required value="{{$editUser->last_name}}" name="last_name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>E-Mail</strong></label>
                        <input required value="{{$editUser->email}}" name="email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Phone</strong></label>
                        <input required value="{{$editUser->phone_number}}" name="phone_number" type="number" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong> Image </strong></label>
                        <input value="{{$editUser->image}}" name="customer_image" type="file" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Address</strong></label>
                        <input required value="{{$editUser->address}}" name="address" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div><br>


                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection