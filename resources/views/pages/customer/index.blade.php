@extends('templates.authenticated')

@section('curr-page')customer-manage @stop

@section('content')

        <!-- Begin: Content -->
<section id="content" class="table-layout animated fadeIn">

    <!-- begin: .tray-center -->
    <div class="tray tray-center p25 va-t posr">

        <!-- Panel Products Table -->

        <div class="panel">
            @if(Session::has('success'))
                <div class="alert alert-success mb10">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="panel-body pn">

                <div id="ajax-result"></div>
                <div id="buttons">
                    <button id="bulkDelete" type="button" class="btn btn-rounded btn-danger btn-sm m10">
                        <i class="fa fa-times mr1"></i>
                        <span class="text">Delete Selected</span>
                    </button>
                </div>
                <table class="table admin-form theme-warning fs13" id="dataTable">
                    <thead>
                    <tr class="bg-light">
                        <th class="">Name</th>
                        <th class="">Address</th>
                        <th class="">City</th>
                        <th class="">Country</th>
                        <th class="">Email</th>
                        <th class="">Mobile</th>

                        <th class="text-right">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end: .tray-center -->

    @include('pages.addons.recent-activities')
</section>
<!-- End: Content -->
@stop

@section('custom-js')
    <script src="{{ asset('scripts/general/general-datatable.js') }}"></script>

    <script>


        function countSelected() {
            var bulk_btns = $('#buttons')
            var checkbox = $('#dataTable').find('input:checked');
            var total = checkbox.length;
            if (total <= 0) {
                bulk_btns.hide(300)
            } else {
                $('#bulkDelete .text').html("Delete " + total + " Customers")
                bulk_btns.show(300)
            }
        }
        $(document).ready(function () {
            //perform Delete
            $('#buttons').hide(300);
            dataTableInit.init("#dataTable",{
                ajax: '{{ route('api-list-customer') }}',
                columns: [
                    {data: 'name', name: 'name', searchable: true, orderable: true},
                    {data: 'address', name: 'address'},
                    {data: 'city', name: 'city'},
                    {data: 'country', name: 'country'},
                    {data: 'email', name: 'email'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
            });

            $(document).on('click', 'a.deleteCustomer', function (e) {
                e.preventDefault();
                var href = $(this).attr('href');
                swal({
                    title: "Are you sure?",
                    text: "<span class='fg-red'>You will not be able to recover this customer!</span>",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Delete",
                    closeOnConfirm: true,
                    html : true,
                }, function () {
                    $.get(href, function (data) {
                        swal({
                            title : data.result.toUpperCase(),
                            text : data.message,
                            type : data.result,
                            html : true,
                        })
                        dataTable.ajax.reload();
                    });
                });
            });


        });
    </script>
@stop