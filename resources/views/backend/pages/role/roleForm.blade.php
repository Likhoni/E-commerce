@extends('backend.master')
@section('content')
    <div style="padding: 20px;">
        <div style="padding:10px;">
            <a href="{{ route('role.list') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <div style="padding-left: 10px;">

            <form action="{{ route('submit.role.form') }}" method="post" enctype="multipart/form-data">

                @csrf
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <h1><strong>Role Create Form </strong></h1><br>

                            <div class="form-group">
                                <label for="exampleFormControlInput1"><strong>Name</strong></label>
                                <input required name="name" type="text" class="form-control"
                                    id="exampleFormControlInput1" placeholder="">
                            </div><br>

                            <div class="form-group">
                                <label for="exampleFormControlInput1"><strong>Status</strong></label>
                                <select name="status" id="" class="form-control">
                                    <option value="active">active</option>
                                    <option value="inactive">inactive</option>
                                </select>
                            </div><br>

                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
