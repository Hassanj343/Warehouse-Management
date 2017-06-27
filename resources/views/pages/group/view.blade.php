@extends('templates.authenticated')

@section('curr-page')group-view @stop

@section('content')

        <!-- Begin: Content -->
<section id="content" class="table-layout animated fadeIn">

    <!-- begin: .tray-center -->
    <div class="tray tray-center p25 va-t posr">
        <!-- Panel Products Table -->
        <div class="panel">
            <div class="panel-heading">
                <span class="title fs16 fg-darkBlue">{{ $data->name }}</span>
            </div>
            <div class="panel-body pn">
                <div class="col-lg-12 text-right mt10">
                    <a href="{{ route('modify-group',$data->id) }}" class="btn btn-primary">
                        <i class="fa fa-pencil mr10"></i>
                        Modify Supplier
                    </a>
                    <a href="{{ route('delete-group',$data->id) }}" class="btn btn-danger" id="deleteBtn">
                        <i class="fa fa-trash-o mr10"></i>
                        Delete Supplier
                    </a>
                </div>

                <div class="col-lg-12">
                    <table class="table admin-form theme-warning tc-checkbox-1 fs14" id="dataTable">
                        <tbody>
                        <tr>
                            <td>Name</td>
                            <td>{{ $data->name }}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-heading">
                <span class="title">Products</span>
            </div>
            <div class="panel-body pn">
                <table class="table admin-form theme-warning tc-checkbox-1 fs14 text-left" id="dataTable">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Quantity Available</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data->listProducts as $key => $val)
                        <tr>
                            <td class="text-left">{{ $val->name }}</td>
                            <td>{{ $val->quantity }}</td>
                            <td>
                                <a href="{{ route('view-product',$val->id) }}" class="btn btn-default">View Product</a>
                            </td>
                        </tr>

                    @endforeach

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
        $('#deleteBtn').click(function (e) {
            e.preventDefault();
            var href = $(this).attr('href');
            swal({
                title: "Are you sure?",
                text: "Are you sure you want to delete this group. Warning data will be permanently deleted?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: true,
                html: true,
            }, function () {
                window.location.href = href;
            });

        });
    </script>

@stop