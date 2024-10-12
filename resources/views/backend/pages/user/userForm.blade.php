@extends('backend.master')
@section('content')
    <div style="padding: 20px;">

        <div style="padding:10px;">
            <a href="{{ route('user.list') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <form action="{{ route('submit.user.form') }}" method="post" enctype="multipart/form-data">

            @csrf
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h1><strong>User Create Form </strong></h1><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>First Name</strong></label>
                            <input required name="first_name" type="text" class="form-control"
                                id="exampleFormControlInput1" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Last Name</strong></label>
                            <input required name="last_name" type="text" class="form-control"
                                id="exampleFormControlInput1" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Role</strong></label>
                            <select name="role_id" id="" class="form-control">
                                <option value="">--Select Option--</option>
                                @foreach ($role as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div><br>

                        <div class="form-group">
                            <label for=""><strong>E-Mail </strong></label>
                            <input required name="email" type="email" class="form-control" id=""
                                placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for=""><strong>Password</strong></label>
                            <input required name="password" type="password" class="form-control" id=""
                                placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for=""><strong> Phone Number </strong></label>
                            <input required name="phone_number" type="phone" class="form-control" id=""
                                placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for=""><strong>User Image</strong></label>
                            <input name="user_image" type="file" class="form-control" id="" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1"><strong>Address</strong></label>
                            <input required name="address" type="text" class="form-control" id=""
                                placeholder="">
                        </div><br>

                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
