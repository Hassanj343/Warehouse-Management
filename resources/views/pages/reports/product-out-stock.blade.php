@extends('templates.authenticated')

@section('curr-page')reports-stock-out @stop

@section('content')

        <!-- Begin: Content -->
<section id="content" class="table-layout animated fadeIn">

    <!-- begin: .tray-center -->
    <div class="tray tray-center p25 va-t posr">

        <!-- Panel Products Table -->

        <div class="panel">
            <div class="panel-heading">
                <span class="title">Product Out of Stock</span>
            </div>
            <div class="panel-body pn">

                <table class="table admin-form theme-warning tc-checkbox-1 fs13" id="dataTable">
                    <thead>
                    <tr class="bg-light">
                        <th class="">Name</th>
                        <th class="">Quantity</th>
                        <th class="">Group</th>
                        <th class="">Supplier</th>
                        <th class="">Location</th>
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

        $(document).ready(function () {
            dataTableInit.init("#dataTable",{
                ajax: '{{ route('report-product-out-stock-products') }}',
                columns: [
                    {data: 'name', name: 'name', searchable: true, orderable: true},
                    {data: 'quantity', name: 'quantity'},
                    {data: 'group', name: 'group'},

                    {data: 'supplier', name: 'supplier'},
                    {data: 'location', name: 'location'}
                ],
            });
        });
    </script>
@stop