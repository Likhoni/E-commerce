@extends('backend.master')

@section('content')
<div style="padding:20px">
    <h1>Group List</h1>
    @if(checkPermission('group.form'))
    <div><a href="{{ route('group.form') }}" class="btn btn-primary">Add New Group</a></div>
    @endif
    <br>
    <table class="data-table">
        <thead>
            <tr>
                <th scope="col">Id </th>
                <th scope="col">Group Name</th>
                <th scope="col">Parent Group</th>
                <th scope="col">Group Slug</th>
                <th scope="col">Group Image</th>
                <th scope="col">Discount</th>
                <th scope="col">Status</th>
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
            ajax: "{{ route('ajax.get.group.data') }}",
            columns: [{

                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'group_name',
                    name: 'group_name'
                },
                {
                    data: 'parent_group',
                    name: 'parent_group'
                },
                {
                    data: 'slug',
                    name: 'slug'
                },                
                {
                    data: 'group_image',
                    name: 'group_image',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'discount',
                    name: 'discount'
                },
                {
                    data: 'status',
                    name: 'status'
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
            var groupId = $(this).data('id');
            if (confirm("Are you sure you want to delete this group?")) {
                // Redirect to the product delete route
                window.location.href = "{{ route('group.delete', '') }}/" + groupId;
            }
        });


    });
</script>

@endpush