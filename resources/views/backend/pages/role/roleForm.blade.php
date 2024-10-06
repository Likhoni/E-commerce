@extends("backend.master")
@section('content')

<div style="padding-left: 10px;">

    <form action="{{route('admin.submit.role.form')}}" method="post" enctype="multipart/form-data">

        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h1><strong>Role Form </strong></h1><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Name</strong></label>
                        <input required name="name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Status</strong></label>
                        <select name="status" id="" class="form-control">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div><br>

                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection