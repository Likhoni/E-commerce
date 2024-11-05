@extends('backend.master')

@section('content')
<div style="padding:20px">
    <h1>Product List</h1>
    @if (checkPermission('product.form'))
    <div><a href="{{ route('product.form') }}" class="btn btn-primary">Add New Product</a></div>
    @endif
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
            serverSide: false,

            ajax: "{{ route('ajax.get.data') }}",

            columns: [

                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'product_name',
                    name: 'product_name'
                },



                {
                    data: 'category_id',
                    name: 'category_id'
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
                    name: 'product_image'
                },

                {
                    data: 'product_description',
                    name: 'product_description'
                },

                

            ]

        });
    });
</script>
@endpush