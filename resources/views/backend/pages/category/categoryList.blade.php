@extends('backend.master')

@section('content')
    <div style="padding:20px">
        <h1>Category List</h1>
        @if (checkPermission('category.form'))
            <div><a href="{{ route('category.form') }}" class="btn btn-primary">Add New Category</a></div>
        @endif
        <br>
        <table class="data-table">
            <thead>
                <tr>
                    <th scope="col">Id </th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Parent Category</th>
                    <th scope="col">Category Image</th>
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
            ajax: "{{ route('ajax.get.category.data') }}",
            columns: [{

                    data: 'id',
                    name: 'id'
                }, 
                {
                    data: 'category_name',
                    name: 'category_name'
                },
                {
                    data: 'parent_category',
                    name: 'parent_category'
                },
                {
                    data: 'category_image',
                    name: 'category_image',
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
            var categoryId = $(this).data('id');
            if (confirm("Are you sure you want to delete this category?")) {
                // Redirect to the product delete route
                window.location.href = "{{ route('category.delete', '') }}/" + categoryId;
            }
        });


    });
</script>

@endpush