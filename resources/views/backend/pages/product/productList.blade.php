@extends('backend.master')

@section('content')
<div style="padding:20px">
    <h1>Product List</h1>
    @if (checkPermission('product.form'))
    <div><a href="{{ route('product.form') }}" class="btn btn-primary">Add New Product</a></div>
    @endif
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
                <th scope="col">Discount</th>
                <th scope="col">Discount Price</th>
                <th scope="col">Product Image</th>
                <th scope="col">Product Description</th>
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
            ajax: "{{ route('ajax.get.data') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'product_name',
                    name: 'product_name'
                },
                {
                    data: 'group_id',
                    name: 'group_id'
                },
                {
                    data: 'category_id',
                    name: 'category_id'
                },
                {
                    data: 'brand_id',
                    name: 'brand_id'
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
                    data: 'discount',
                    name: 'discount'
                },
                {
                    data: 'discount_price',
                    name: 'discount_price'
                },
                {
                    data: 'product_image',
                    name: 'product_image',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'product_description',
                    name: 'product_description'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // Handle delete button click
        $('.data-table').on('click', '.delete', function() {
            var productId = $(this).data('id');
            if (confirm("Are you sure you want to delete this product?")) {
                $.ajax({
                    url: "{{ route('product.delete', '') }}/" + productId,
                    type: "GET",
                    success: function(response) {
                        alert("Product deleted successfully");
                        table.ajax.reload(); // Refresh DataTable
                    },
                    error: function(xhr) {
                        alert("An error occurred while deleting the product");
                    }
                });
            }
        });
    });
</script>

@endpush