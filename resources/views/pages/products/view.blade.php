@extends('templates.authenticated')

@section('curr-page')products-view @stop

@section('content')

<?php 
    $types = config('app_config.product_type');
?>

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
                    <a href="{{ route('modify-product',$data->id) }}" class="btn btn-primary">
                        <i class="fa fa-pencil mr10"></i>
                        Modify Product
                    </a>
                    <a href="{{ route('delete-product',$data->id) }}" class="btn btn-danger " id="deleteBtn">
                        <i class="fa fa-trash-o mr10"></i>
                        Delete Product
                    </a>
                </div>
                <img src="{{ $data->image ? asset($data->image) : 'http://placehold.it/500x500&&text=Placeholder' }}"
                     width="100%" height="100%" class="col-lg-4 mt10 mb10">

                <div class="col-lg-8">
                    <table class="table admin-form theme-warning tc-checkbox-1 fs14" id="dataTable">
                        <tbody>
                        <tr>
                            <td>Name</td>
                            <td>{{ $data->name }}</td>
                        </tr>
                        <?php $price = unserialize($data->price) ?>
                        <tr>
                            <td>Purchase Price</td>
                            <td>{{ \HelperFunctions::getCurrentCurrency() }} {{ $price['purchase_price'] }}</td>
                        </tr>
                        <tr>
                            <td>Sale Price</td>
                            <td>{{ \HelperFunctions::getCurrentCurrency() }} {{ $price['sale_price'] }}</td>
                        </tr>
                        <tr>
                            <td>Quantity in Stock</td>
                            <td>{{ $data->quantity }}</td>
                        </tr>
                        <tr>
                            <td>Location</td>
                            <td>{{ $data->location }}</td>
                        </tr>
                        <tr>
                            <td>Type</td>
                            <td>{{ array_key_exists($data->type, $types) ? $types[$data->type] : '' }}</td>
                        </tr>
                        <tr>
                            <td>Code</td>
                            <td>{{ $data->barcode }}</td>
                        </tr>
                        <tr>
                            <td>Supplier</td>
                            <?php $supplier = \App\Models\Supplier::find($data->supplier_id)?>
                            <td>
                                @if(!is_null($supplier))
                                    {{ $supplier->name }}
                                    <span class="pull-right">
                                        <a href="{{ route('view-supplier',$supplier->id) }}"
                                           class="button primary bg-hover-black fg-hover-white">View Supplier</a>
                                    </span>
                                @else
                                    Unknown
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Group</td>
                            <?php $group = \App\Models\Group::find($data->group_id);?>
                            <td>{{ !is_null($group) ? $group->name : 'Unknown' }}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>{{ $data->description }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
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
                text: "Are you sure you want to delete this product. Warning data will be permanently deleted?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                closeOnConfirm: true,
                html : true,
            }, function () {
                window.location.href = href;
            });

        });
    </script>

@stop
