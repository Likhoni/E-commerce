@extends('backend.master')

@section('content')
<div style="padding:20px">
    <h1>Brand List</h1>
    @if (checkPermission('brand.form'))
    <div><a href="{{ route('brand.form') }}" class="btn btn-primary">Add New Brand</a></div>
    @endif
    <br>
    <table class="data-table">
        <thead>
            <tr>
                <th scope="col">Id </th>
                <th scope="col">Brand Name</th>
                <th scope="col">Category name</th>
                <th scope="col">Parent Brand</th>
                <th scope="col">Brand Image</th>
                <th scope="col">Discount</th>
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
            ajax: "{{ route('ajax.get.brand.data') }}",
            columns: [{

                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'brand_name',
                    name: 'brand_name'
                },
                {
                    data: 'category_name',
                    name: 'category_name'
                },
                {
                    data: 'parent_brand',
                    name: 'parent_brand'
                },
                {
                    data: 'brand_image',
                    name: 'brand_image',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'discount',
                    name: 'discount'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ]
        });

        //delete
        $('.data-table').on('click', '.delete', function() {
            var brandId = $(this).data('id');
            if (confirm("Are you sure you want to delete this brand?")) {
                window.location.href = "{{ route('brand.delete', '') }}/" + brandId;
            }
        });


    });
</script>

@endpush