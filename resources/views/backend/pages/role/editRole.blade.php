@extends('backend.master')

@section('content')
    <div style="padding: 20px;">

        <form action="{{ route('role.update', $editRole->id) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h1><strong>Update Role Form</strong></h1><br>


                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Name</strong></label>
                            <input required value="{{ $editRole->name }}" name="name" type="text" class="form-control"
                                id="exampleFormControlInput1" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Status</strong></label>
                            <select name="status" id="" class="form-control">
                                <option value="{{ $editRole->status }}">{{ $editRole->status }}</option>
                                <option value="active">active</option>
                                <option value="inactive">inactive</option>
                            </select>
                        </div><br>


                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
