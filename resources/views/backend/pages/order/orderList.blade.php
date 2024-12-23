@extends('backend.master')

@section('content')
    <div style="padding:20px">
        <h1>Order List</h1>
        @if (checkPermission('order.form'))
            <div><a href="{{ route('order.form') }}" class="btn btn-primary">Add New Order</a></div>
        @endif
        <br>
        <table class="data-table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Contact Number</th>
                    <th scope="col">Country</th>
                    <th scope="col">Division</th>
                    <th scope="col">District</th>
                    <th scope="col">Upazila</th>
                    <th scope="col">Union</th>
                    <th scope="col">Address</th>
                    <th scope="col">Sub Total</th>
                    <th scope="col">Payment Method</th>
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
            ajax: "{{ route('ajax.get.order.data') }}",
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
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'contact_number',
                    name: 'contact_number'
                },
                {
                    data: 'country',
                    name: 'country'
                },
                {
                    data: 'division_name',
                    name: 'division_name',
                },               
                {
                    data: 'district_name',
                    name: 'district_name',
                },                
                {
                    data: 'upazila_name',
                    name: 'upazila_name',
                },
                {
                    data: 'union_name',
                    name: 'union_name',
                },                
                {
                    data: 'address',
                    name: 'address',
                },                
                {
                    data: 'amount',
                    name: 'amount',
                },                                                
                {
                    data: 'payment_method',
                    name: 'payment_method',
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
            var orderId = $(this).data('id');
            if (confirm("Are you sure you want to delete this order?")) {
                window.location.href = "{{ route('order.delete', '') }}/" + orderId;
            }
        });
    });
</script>
@endpush
