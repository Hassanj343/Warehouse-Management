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
                    <span class="title fs16 fg-darkBlue">{{ $product->name }}</span>
                </div>
                <div class="panel-body pn">
                    <div class="col-lg-12 text-right mt10">
                        <a href="{{ route('modify-product',$product->id) }}" class="btn btn-primary">
                            <i class="fa fa-pencil mr10"></i>
                            Modify Product
                        </a>
                        <a href="{{ route('delete-product',$product->id) }}" class="btn btn-danger " id="deleteBtn">
                            <i class="fa fa-trash-o mr10"></i>
                            Delete Product
                        </a>
                    </div>
                    <img src="{{ $product->image ? asset($product->image) : 'http://placehold.it/500x500&&text=Placeholder' }}"
                         width="100%" height="100%" class="col-lg-4 mt10 mb10">

                    <div class="col-lg-8">
                        <table class="table admin-form theme-warning tc-checkbox-1 fs14" id="dataTable">
                            <tbody>
                            <tr>
                                <td>Name</td>
                                <td>{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <td>Purchase Price</td>
                                <td>{{ formatCurrency($product->purchase_price) }}</td>
                            </tr>
                            <tr>
                                <td>Sale Price</td>
                                <td>{{ formatCurrency($product->sale_price) }}</td>
                            </tr>
                            <tr>
                                <td>Quantity in Stock</td>
                                <td>{{ $product->quantity }}</td>
                            </tr>
                            <tr>
                                <td>Location</td>
                                <td>{{ $product->location }}</td>
                            </tr>
                            <tr>
                                <td>Type</td>
                                <td>{{ array_key_exists($product->type, $types) ? $types[$product->type] : '' }}</td>
                            </tr>
                            <tr>
                                <td>Code</td>
                                <td>{{ $product->barcode }}</td>
                            </tr>
                            <tr>
                                <td>Supplier</td>
                                <?php $supplier = $product->supplier;?>
                                <td>
                                    @if(!is_null($supplier))
                                        {{ $supplier->name }}
                                        <span class="pull-right">
                                            <a href="{{ route('view-supplier',$supplier->id) }}"
                                               class="btn btn-primary btn-sm primary bg-hover-black fg-hover-white">View Supplier</a>
                                        </span>
                                    @else
                                        Unknown
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Group</td>
                                <?php $group = $product->group;?>
                                <td>{{ !is_null($group) ? $group->name : 'Unknown' }}</td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>{{ $product->description }}</td>
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
                html: true,
            }, function () {
                window.location.href = href;
            });

        });
    </script>

@stop
