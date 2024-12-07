@extends('backend.master')

@section('content')
<div style="padding:20px">
    <h1>Product List</h1>
    @if (checkPermission('product.form'))
    <div><a href="{{ route('product.form') }}" class="btn btn-primary">Add New Product</a></div>
    @endif
    <br>
    <div class="col-md-6">
        <form action="{{route('set.alert.stock')}}" method="post">
            @csrf

            <input value="{{session()->get('alert')}}" name="alert_quantity" type="text" class="form-control" placeholder="Enter Stock alert" style="width: 200px; display: inline;">
            <button class="btn btn-success">Set</button>

        </form>
    </div>
    <br>
    <table class="data-table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Product Name</th>
                <th scope="col">Group Name</th>
                <th scope="col">Category Name</th>
                <th scope="col">Brand Name</th>
                <th scope="col">Product Quantity</th>
                <th scope="col">Product Price</th>
                <th scope="col">Product Image</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
@endsection

@push('js')
<script type="text/javascript">
    $(function() {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('ajax.get.product.data') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'product_name',
                    name: 'product_name'
                },
                {
                    data: 'group_name',
                    name: 'group_name'
                },
                {
                    data: 'category_name',
                    name: 'category_name'
                },
                {
                    data: 'brand_name',
                    name: 'brand_name'
                },
                {
                    data: 'product_quantity',
                    name: 'product_quantity'
                },
                {
                    data: 'product_price',
                    name: 'product_price'
                },
                {
                    data: 'product_image',
                    name: 'product_image',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // Delete functionality
        $('.data-table').on('click', '.delete', function() {
            var productId = $(this).data('id');
            if (confirm("Are you sure you want to delete this product?")) {
                // Redirect to the product delete route
                window.location.href = "{{ route('product.delete', '') }}/" + productId;
            }
        });
    });
</script>
@endpush