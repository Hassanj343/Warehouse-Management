@extends('templates.authenticated')

@section('curr-page')shipment-view @stop

@section('content')
<?php
$company_name = HelperFunctions::getSettings('company-name');
$company_address = HelperFunctions::getSettings('company-address');
$company_city = HelperFunctions::getSettings('company-city');
$company_country = HelperFunctions::getSettings('company-country');
$company_postcode = HelperFunctions::getSettings('company-postcode');
$company_email = HelperFunctions::getSettings('company-email');
$currency_symbol = HelperFunctions::getCurrentCurrency();
$subtotal = 0;
$store_tos = HelperFunctions::getSettings('store-tos');
$privacy_policy = HelperFunctions::getSettings('privacy-policy');
$refund_policy = HelperFunctions::getSettings('refund-policy');
$tax = HelperFunctions::getSettings('general-tax-rate');
$product_activity = $data->getProductActivity;
$customer = $data->getCustomer;
$activity = array();
foreach ($product_activity as $key => $value) {
    if (array_key_exists($value->product_id, $activity)) {
        $activity[$value->product_id]['quantity'] += $value->quantity;
    } else {
        $activity[$value->product_id] = $value;
    }
}
?>
        <!-- Begin: Content -->
<section id="content" class="table-layout animated fadeIn">

    <!-- begin: .tray-center -->
    <div class="tray tray-center p25 va-t posr">


        <!-- Panel Products Table -->
        <div class="panel">
            <div class="panel-heading">
                <span class="title fs16 fg-darkBlue">View Shipment</span>
                <div class="pull-right">
                    <a href="{{ route('reports-view-invoice',$data->id) }}" class="btn btn-primary">
                        <span class="fa fa-file-pdf-o"></span>
                        Download PDF
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-md-6">
                    <h1>
                        {{ $company_name }}
                    </h1>
                </div>
                <div class="col-md-6 text-right">
                    <h1>INVOICE</h1>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>{{ $company_name }}</h4>
                            </div>
                            <div class="panel-body">
                                <p>
                                    {{ $company_address }}<br>
                                    {{ $company_postcode }}, {{ $company_city }} <br>
                                    {{ $company_country }} <br>
                                    {{ $company_email }} <br>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-md-offset-2 text-right">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>{{ $customer->name }}</h4>
                            </div>
                            <div class="panel-body">
                                <p>
                                    {{ $customer->address }}<br>
                                    {{ $customer->city }} <br>
                                    {{ $customer->country }} <br>
                                    {{ $customer->email }} <br>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / end client details section -->
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>
                            <h4>Product</h4>
                        </th>
                        <th>
                            <h4>Quantity</h4>
                        </th>
                        <th>
                            <h4>Price</h4>
                        </th>
                        <th>
                            <h4>Sub Total</h4>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($activity as $key => $value)
                        <?php $product = $value->getProduct;
                        $subtotal += ($value->sale_price * $value->quantity); ?>

                        <tr>
                            <td>{{ $product ? $product->name : '' }}</td>
                            <td>{{ $value->quantity }}</td>
                            <td class="text-right">{{ $currency_symbol }} {{ number_format($value->sale_price,2) }}</td>
                            <td class="text-right">{{ $currency_symbol }} {{ number_format(($value->sale_price * $value->quantity),2) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="row text-right">
                    <div class="col-md-2 col-md-offset-8">
                        <p>
                            <strong>
                                Sub Total : <br>
                                TAX : <br>
                                Total : <br>
                            </strong>
                        </p>
                    </div>
                    <div class="col-md-2">

                        {{ $currency_symbol }} {{ number_format($subtotal,2) }}<br>
                        {{ $tax }} % <br>
                        {{ $currency_symbol }} {{ number_format($subtotal + ($subtotal * ($tax / 100)),2) }}<br>

                    </div>
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
                text: "Are you sure you want to delete this shipment. Warning data will be permanently deleted?",
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