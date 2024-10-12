@extends('backend.master')

@section('content')
    <div style="padding: 20px;">

        <form action="{{ route('group.update', $editGroup->id) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">

                        <h1><strong> Update Group Form</strong></h1><br>
                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Group Name</strong></label>
                            <input required value="{{ $editGroup->group_name }}" name="group_name"
                                type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for=""><strong>Group Image</strong></label>
                            <input value="{{ $editGroup->group_image }}" name="group_image" type="file"
                                class="form-control" id="" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for=""><strong>Discount</strong></label>
                            <input value="{{ $editGroup->discount }}" name="discount" type="number" class="form-control"
                                id="" placeholder="">
                        </div><br>

                        <div class="form-group">
                            <label for="exampleFormControlInput1"><strong>Status</strong></label>
                            <select name="status" id="" class="form-control">
                                <option value="{{ $editGroup->status }}">{{ $editGroup->status }}</option>
                                <option value="active">active</option>
                                <option value="inactive">inactive</option>
                            </select>
                        </div><br>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
