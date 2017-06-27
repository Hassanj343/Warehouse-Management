@extends('templates.authenticated')

@section('curr-page')reports-group-stock @stop

@section('content')

        <!-- Begin: Content -->
<section id="content" class="table-layout animated fadeIn">

    <!-- begin: .tray-center -->
    <div class="tray tray-center p25 va-t posr">

        <!-- Panel Products Table -->
        <div class="panel">
            <div class="panel-heading">
                <span class="title">Group Stock Report</span>
            </div>
            <div class="panel-body row">
                <div class="col-lg-12">
                    <form method="post" class="form-horizontal mt10" role="form" id="groupForm">
                    {{ csrf_field() }}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="groups" class="col-md-12">Group</label>

                                <div class="col-md-12">
                                    <select name="group" id="groups" class="form-control">
                                        <option value=""> -- Select One -- </option>
                                        @foreach(\App\Models\Group::all() as $key => $group)
                                            <option value="{{ $group->id }}"> {{ $group->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="form-group">
                                <button class="btn btn-primary" id="filterBtn">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel-footer" id="GroupResult">
                <table class="table admin-form theme-warning tc-checkbox-1 fs13" id="dataTable">
                    <thead>
                    <tr class="bg-light">
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Supplier</th>
                        <th>Location</th>
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
            var table;
            $('#GroupResult').hide();
            $('#groups').select2();

            $('#groupForm').submit(function(e){
                e.preventDefault();
                $('#GroupResult').hide(300);
                var $id = $('#groups').val();
                if($id){
                    var url = '{{ \URL::to('report/group-stock-alert') }}' + '/' + $id;
                    if(table) {
                        table.ajax.url( url ).load();
                    } else {
                        table = dataTableInit.init("#dataTable",{
                            ajax: url,
                            columns: [
                                {data: 'name', name: 'name', searchable: true, orderable: true},
                                {data: 'quantity', name: 'quantity', orderable: true},
                                {data: 'supplier', name: 'supplier', searchable: true, orderable: true},
                                {data: 'location', name: 'location', searchable: true, orderable: true}
                            ],
                        });
                    }
                    $('#GroupResult').show(300);
                }
            });

        });
    </script>
@stop