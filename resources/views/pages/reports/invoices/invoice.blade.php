<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <style>
        @import url(http://fonts.googleapis.com/css?family=Bree+Serif);

        body, h1, h2, h3, h4, h5, h6 {
            font-family: 'Bree Serif', serif;
        }

        .page {
            overflow: hidden;
            page-break-after: always;
        }
    </style>

</head>
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
?>
<body>
<div class="container page">
    <div class="row">
        <div class="col-xs-6">
            <h1>
                {{ $company_name }}
            </h1>
        </div>
        <div class="col-xs-6 text-right">
            <h1>INVOICE</h1>

            <h3>
                <small>
                    Date {{ $info['invoice_date'] }}<br>
                    Invoice #{{ $info['invoice_reference'] }}
                </small>
            </h3>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-5">
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
        <div class="col-xs-5 col-xs-offset-2 text-right">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>{{ $info['customer_name'] }}</h4>
                </div>
                <div class="panel-body">
                    <p>
                        {{ $info['customer_address'] }}<br>
                        {{ $info['customer_city'] }} <br>
                        {{ $info['customer_country'] }} <br>
                        {{ $info['customer_email'] }} <br>
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
            <?php
            $product = $value->getProduct;
            $subtotal += ($value->sale_price * $value->quantity);
            ?>
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $value->quantity }}</td>
                <td class="text-right">{{ $currency_symbol }} {{ number_format($value->sale_price,2) }}</td>
                <td class="text-right">{{ $currency_symbol }} {{ number_format(($value->sale_price * $value->quantity),2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="row text-right">
        <div class="col-xs-2 col-xs-offset-8">
            <p>
                <strong>
                    Sub Total : <br>
                    TAX : <br>
                    Total : <br>
                </strong>
            </p>
        </div>
        <div class="col-xs-2">

            {{ $currency_symbol }} {{ number_format($subtotal,2) }}<br>
            {{ $info['invoice_tax'] }} % <br>
            {{ $currency_symbol }} {{ number_format($subtotal + ($subtotal * ($info['invoice_tax'] / 100)),2) }}<br>

        </div>
    </div>
</div>

<div class="container page">
    <div class="row">
        <div class="col-sm-12">
            <h3>Terms and Conditions</h3>
            <p>{{ $store_tos }}</p>
        </div>
        <div class="col-sm-12">
            <h3>Refund Policy</h3>
            <p>{{ $refund_policy }}</p>
        </div>
        <div class="col-sm-12">
            <h3>Privacy Policy</h3>
            <p>{{ $privacy_policy }}</p>
        </div>
    </div>
</div>
</body>
</html>


</html>