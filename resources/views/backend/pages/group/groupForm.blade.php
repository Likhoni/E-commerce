@extends('backend.master')

@section('content')
    <div style="padding: 20px;">

        <div style="padding:10px;">
            <a href="{{ route('admin.group.list') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
        <form action="{{ route('admin.submit.group.form') }}" method="post" enctype="multipart/form-data">

            @csrf
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">

                        <h1><strong>Group Create Form</strong></h1><br>
                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Group Name</strong></label>
                            <input required name="group_name" type="text" class="form-control"
                                id="exampleFormControlInput1" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for=""><strong>Group Image</strong></label>
                            <input name="group_image" type="file" class="form-control" id=""
                                placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for=""><strong>Group Status</strong></label>
                            <select name="status" id="" class="form-control">
                                <option value="active">--Select Option--</option>
                                <option value="active">active</option>
                                <option value="inactive">inactive</option>
                            </select>
                        </div><br>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
