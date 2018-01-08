@extends('templates.authenticated')

@section('curr-page')products-manage @stop

@section('content')

    <!-- Begin: Content -->
    <section id="content" class="table-layout animated fadeIn">

        <!-- begin: .tray-center -->
        <div class="tray tray-center p25 va-t posr">

            <!-- Panel Products Table -->
            <div class="panel">
                <div class="panel-menu p12 admin-form theme-primary ">
                    <div class="row">
                        <div id="ajax-result"></div>
                        <div id="buttons" class="pull-left">
                            <button id="bulkDelete" type="button" class="btn btn-rounded btn-danger btn-sm m10">
                                <i class="fa fa-times mr1"></i>
                                <span class="text">Delete Selected</span>
                            </button>
                        </div>
                        <div class="pull-right text-right mr10">
                            <a href="{{ route('create-product') }}" class="btn btn-primary">
                                <i class="fa fa-plus-circle"></i>
                                Create Product
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    {!! $dataTable->table(['class' => 'table table-responsive', 'id' => 'dataTable']) !!}
                </div>
            </div>
        </div>
        <!-- end: .tray-center -->

        @include('pages.addons.recent-activities')
    </section>
    <!-- End: Content -->
@stop

@section('custom-js')
    <script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.colVis.min.js"></script>
    <script type="text/javascript"
            src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    {!! $dataTable->scripts() !!}
@stop