@extends('templates.authenticated')

@section('curr-page')shipment-manage @stop

@section('content')

        <!-- Begin: Content -->
<section id="content" class="table-layout animated fadeIn">

    <!-- begin: .tray-center -->
    <div class="tray tray-center p25 va-t posr">

        <!-- Panel Products Table -->
        <div class="panel">
            <div class="panel-menu p12 admin-form theme-primary">
                <div class="row">
                    <div id="ajax-result"></div>
                    <div id="buttons" class="pull-left">
                        <button id="bulkDelete" type="button" class="btn btn-rounded btn-danger btn-sm m10">
                            <i class="fa fa-times mr1"></i>
                            <span class="text">Delete Selected</span>
                        </button>
                    </div>
                    <div class="pull-right text-right mr10">
                        <a href="{{ route('create-quick-shipment') }}" class="btn btn-primary">
                            <i class="fa fa-plus-circle"></i>
                            Quick Sell
                        </a>
                        <a href="{{ route('create-shipment') }}" class="btn btn-primary">
                            <i class="fa fa-plus-circle"></i>
                            Create Shipment
                        </a>
                    </div>
                </div>
            </div>
            <div class="panel-body pn">
                <div id="ajax-result"></div>
                <table class="table admin-form theme-warning tc-checkbox-1 fs13" id="dataTable">
                    <thead>
                    <tr class="bg-light">
                        <th class="">Select</th>
                        <th class="">Date</th>
                        <th class="">Customer</th>
                        <th class="">Created By</th>
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
    <script src="{{ asset('scripts/jquery/shipments/index.js') }}"></script>

    <script>
        $.extend(true, options, {
            dataTable: {
                href: '{{ route('api-list-shipment') }}'
            },
            bulkDelete: {
                href: '{{ route('api-bulk-delete-shipment')  }}',
            },
        });

    </script>
@stop