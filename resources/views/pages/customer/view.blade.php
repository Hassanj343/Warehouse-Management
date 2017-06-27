@extends('templates.authenticated')

@section('curr-page')customer-view @stop

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
                    <a href="{{ route('modify-customer',$data->id) }}" class="btn btn-primary">
                        <i class="fa fa-pencil mr10"></i>
                        Modify Supplier
                    </a>
                    <a href="{{ route('delete-customer',$data->id) }}" class="btn btn-danger" id="deleteBtn">
                        <i class="fa fa-trash-o mr10"></i>
                        Delete Supplier
                    </a>
                </div>

                <div class="col-lg-12">
                    <table class="table admin-form theme-warning tc-checkbox-1 fs14" id="dataTable">
                        <tbody>
                        <tr>
                            <td class="text-left">Name</td>
                            <td class="text-left">{{ $data->name }}</td>
                        </tr>
                        <tr>
                            <td class="text-left">Address</td>
                            <td class="text-left">{{ $data->address }}</td>
                        </tr>
                        <tr>
                            <td class="text-left">City</td>
                            <td class="text-left">{{ $data->city }}</td>
                        </tr>
                        <tr>
                            <td class="text-left">Country</td>
                            <td class="text-left">{{ $data->country }}</td>
                        </tr>
                        <tr>
                            <td class="text-left">Mobile</td>
                            <td class="text-left">{{ $data->mobile }}</td>
                        </tr>
                        <tr>
                            <td class="text-left">Telephone</td>
                            <td class="text-left">{{ $data->telephone }}</td>
                        </tr>
                        <tr>
                            <td class="text-left">E-Mail</td>
                            <td class="text-left">{{ $data->email }}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel">
            <div class="panel-heading">
                <span class="title">Shipments</span>
            </div>
            <div class="panel-body pn">
                <table class="table admin-form theme-warning tc-checkbox-1 fs14 text-left" id="dataTable">
                    <thead>
                    <tr>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data->getShipments as $key => $val)
                        <tr>
                            <td class="text-left">{{ date('H:i:s D, d M Y', strtotime($data->created_at)) }}</td>

                            <td>
                                <a href="{{ route('view-shipment',$val->id) }}" class="btn btn-default">View Shipment</a>
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
                text: "Are you sure you want to delete this customer. Warning data will be permanently deleted?",
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