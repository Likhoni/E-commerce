@extends('backend.master')

@section('content')
    <div style="padding: 20px;">

        <form action="{{ route('user.update', $editUser->id) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h1><strong>Update User Form</strong></h1><br>


                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>First Name</strong></label>
                            <input required value="{{ $editUser->first_name }}" name="first_name" type="text"
                                class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Last Name</strong></label>
                            <input required value="{{ $editUser->last_name }}" name="last_name" type="text"
                                class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Role</strong></label>
                            <select name="role_id" id="" class="form-control">
                                <option value="{{ $editUser->role_id }}">{{ $editUser->role->name }}</option>
                                @foreach ($role as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>E-Mail</strong></label>
                            <input required value="{{ $editUser->email }}" name="email" type="email"
                                class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Phone</strong></label>
                            <input value="{{ $editUser->phone_number }}" name="phone_number" type="tel"
                                class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong> Image </strong></label>
                            <img style="width: 100px;height:100px" src="{{ url('images/users', $editUser->image) }}"
                                alt="">
                            <input value="{{ $editUser->image }}" name="image" type="file" class="form-control"
                                id="exampleFormControlInput1" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Address</strong></label>
                            <input value="{{ $editUser->address }}" name="address" type="text" class="form-control"
                                id="exampleFormControlInput1" placeholder="">
                        </div><br>


                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
