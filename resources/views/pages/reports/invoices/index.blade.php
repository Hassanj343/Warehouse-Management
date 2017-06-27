@extends('templates.authenticated')

@section('curr-page')reports-shipment-invoices @stop

@section('content')

        <!-- Begin: Content -->
<section id="content" class="table-layout animated fadeIn">

    <!-- begin: .tray-center -->
    <div class="tray tray-center p25 va-t posr">

        <!-- Panel Products Table -->
        <div class="panel">
            <div class="panel-body pn">
                <div id="ajax-result"></div>
                <table class="table admin-form theme-warning tc-checkbox-1 fs13" id="dataTable">
                    <thead>
                    <tr class="bg-light">
                        <th class="text-left">Date</th>
                        <th class="">Customer</th>
                        <th class="">Products</th>
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
    <script>
        dataTableInit.init("#dataTable",{
             ajax: '{{ route('api-report-list-shipment') }}',
            columns: [
                {data: 'date', name: 'date', searchable: true},
                {data: 'customer', name: 'customer'},
                {data: 'products', name: 'products'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
        });
    </script>
@stop