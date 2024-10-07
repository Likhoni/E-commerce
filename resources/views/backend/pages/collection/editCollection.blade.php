@extends("backend.master")

@section('content')
<div style="padding-left: 10px;">

    <form action="{{route('admin.collection.update',$editCollection->id)}}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">

                    <h1><strong> Update Collection Form</strong></h1><br>
                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Collection Name</strong></label>
                        <input required value="{{$editCollection->collection_name}}" name="collection_name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for=""><strong>Collection Image</strong></label>
                        <input value="{{$editCollection->collection_image}}" name="collection_image" type="file" class="form-control" id="" placeholder="">
                    </div><br>

                    <div class="form-group">
                        <label for="exampleFormControlInput1"><strong>Status</strong></label>
                        <select name="status" id="" class="form-control">
                            <option value="{{$editCollection->status}}">{{$editCollection->status}}</option>
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