@extends('templates.authenticated')

@section('curr-page')group-manage @stop

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
                <table class="table theme-warning display responsive fs13" id="dataTable">
                    <thead>
                    <tr class="bg-light">
                        <th style="width:10%; text-align: left;">Select</th>
                        <th>Name</th>
                        <th>Products</th>
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
                $('#bulkDelete .text').html("Delete " + total + " Groups")
                bulk_btns.show(300)
            }
        }
        $(document).ready(function () {
            //perform Delete
            $('#buttons').hide(300);
            dataTableInit.init("#dataTable",{
                ajax: '{{ route('api-list-group') }}',
                columns: [
                    {data: 'select', name: 'select', searchable: false, orderable: false, className: "desktop"},
                    {data: 'name', name: 'name', searchable: true, orderable: true, className: "all"},
                    {data: 'products', name: 'products', className: "all"},
                    {data: 'action', name: 'action', orderable: false, searchable: false, className: "min-tablet"}
                ],
            });
            $('#bulkDelete').click(function (e) {
                e.preventDefault();
                var checkbox = $('#dataTable').find('input:checked');
                var total = checkbox.length;
                swal({
                    title: "Are you sure?",
                    text: "Are you sure you want to delete '" + total + "' groups. Warning data will be permanently deleted?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    closeOnConfirm: true,
                    html : true,
                }, function () {
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('api-bulk-delete-group')  }}',
                        data: checkbox.serialize(),
                        cache: false,
                        success: function (data) {
                            console.log(data);
                            if (data.result = 'success') {
                                var html = '<div class="alert alert-sm alert-border-left alert-success dark alert-dismissable">' +
                                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                                        data.message +
                                        '</div>';
                                $("#ajax-result").html(html);
                                table.ajax.reload();

                            } else if (data.result == 'error') {
                                var html = '<div class="alert alert-sm alert-border-left alert-danger light alert-dismissable">' +
                                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                                        data.message +
                                        '</div>';
                                $("#ajax-result").html(html);
                            }
                        }
                    });
                });
            })


        });
    </script>
@stop