@extends('templates.authenticated')

@section('page-title') Product Sale Report @stop

@section('curr-page')reports-sales @stop

@section('content')
<?php
$submitted ? $submitted : false;
?>
        <!-- Begin: Content -->
<section id="content" class="table-layout animated fadeIn">

    <!-- begin: .tray-center -->
    <div class="tray tray-center p25 va-t posr">

        <!-- Panel Products Table -->
        <div class="panel">
            <div class="panel-heading">
                <span class="title">Product Sale Report</span>
            </div>
            @if(!$submitted)
                <div class="panel-body row">
                    <div class="col-lg-12">
                        <form method="post" class="form-horizontal mt10" role="form" action="{{ route('post-report-product-sales') }}" id="groupForm">
                            {{ csrf_field() }}
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="products" class="col-md-12">Product</label>

                                    <div class="col-md-12">
                                        <select name="product" id="products" class="form-control">
                                            <option value=""> -- Select One --</option>
                                            @foreach(\App\Models\Product::all() as $key => $product)
                                                <option value="{{ $product->id }}"> {{ $product->name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="products" class="col-md-12">Date Range</label>

                                    <div class="col-md-12">
                                        <input type="text" id="datePicker" name="daterange" class="form-control pull-right active">
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
            @endif
            @if($submitted)
                <div class="panel-footer" id="GroupResult">
                    <table class="table admin-form theme-warning tc-checkbox-1 fs13" id="dataTable">
                        <thead>
                        <tr class="bg-light">
                            <th>Time</th>
                            <th>Date</th>
                            <th>Sale Price</th>
                            <th>Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key => $value)
                                <?php
                                        $product = \App\Models\Product::find($value->product_id);
                                ?>
                                <tr>
                                    <td>{{ date('H:i:s',strtotime($value->time)) }}</td>
                                    <td>{{ date('D d M Y',strtotime($value->date)) }}</td>
                                    <td>{{ \HelperFunctions::getCurrentCurrency() }} {{ number_format($value->sale_price, 2) }}</td>
                                    <td>{{ $value->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    <!-- end: .tray-center -->

    @include('pages.addons.recent-activities')
</section>
<!-- End: Content -->
@stop

@section('custom-js')
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/globalize/0.1.1/globalize.min.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.3/moment.js"></script>
    <script type="text/javascript" src="{{ asset('vendor/plugins/daterange/daterangepicker.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#products').select2();
            $('#datePicker').daterangepicker();
            dataTableInit.init("#dataTable",{});
        });
    </script>
@stop