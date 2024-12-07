@extends('backend.master')

@section('content')
    <div style="padding:20px">
        <h1>Customer List</h1>
        <table class="data-table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Full Name</th>
                    <th scope="col">E-Mail</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Image</th>
                    <th scope="col">Address</th>
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
            ajax: "{{ route('ajax.get.customer.data') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'first_name',
                    name: 'first_name'
                },
                {
                    data: 'last_name',
                    name: 'last_name'
                },
                {
                    data: 'full_name',
                    name: 'full_name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'phone_number',
                    name: 'phone_number'
                },
                {
                    data: 'customer_image',
                    name: 'customer_image',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'address',
                    name: 'address'
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
            var customerId = $(this).data('id');
            if (confirm("Are you sure you want to delete this customer?")) {
                window.location.href = "{{ route('customer.delete', '') }}/" + customerId;
            }
        });
    });
</script>
@endpush
