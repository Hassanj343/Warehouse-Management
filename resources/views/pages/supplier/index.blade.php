@extends('templates.authenticated')

@section('curr-page')supplier-manage @stop
@section('custom-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
@stop

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
    <script type="text/javascript">
        function deleteSupplier(button, name){
            var button_hrf = $(button).data('target');
            $.confirm({
                type: 'red',
                title: 'Are you sure!',
                content: "Supplier <strong>" + name +'</strong> will be deleted permanently!',
                buttons: {
                    tryAgain: {
                        text: 'Yes',
                        btnClass: 'btn-danger',
                        action: function(){
                            document.location.href = button_hrf;
                        }
                    },
                    close: function () {
                    }
                }
            });
        }    
    </script>
@stop
