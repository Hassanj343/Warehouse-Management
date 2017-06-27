<?php
// Products
Route::get('report/product-report', array(
    'as' => 'reports-view-products', function () {
        return view('pages.reports.products-report');
    }
));
Route::get('report/products/list', array(
    'as' => 'report-list-products', 'uses' => 'ReportController@list_products'
));

// Stock Alerts Levels
Route::get('report/stock-alert/{id}', array(
    'as' => 'report-stock-alert', function ($id) {
        return view('pages.reports.stock-alert',compact('id'));
    }
));
Route::get('report/stock-alert/{level}/products', array(
    'as' => 'report-stock-alert-products', 'uses' => 'ReportController@list_stockAlertProducts'
));

// Group Stock Alerts
Route::get('report/group-stock-alert', array(
    'as' => 'report-group-stock', function () {
        return view('pages.reports.group-stock-report');
    }
));

Route::get('report/group-stock-alert/{id}', array(
    'as' => 'report-group-stock-products', 'uses' => 'ReportController@list_groupProducts'
));

// Product Out Of stock
Route::get('report/product-out-of-stock/products', array(
    'as' => 'report-product-out-stock', function () {
        return view('pages.reports.product-out-stock');
    }
));
Route::get('report/report-product-out-of-stock/products', array(
    'as' => 'report-product-out-stock-products', 'uses' => 'ReportController@list_outOfStockProducts'
));

// Product Sales Report
Route::get('report/sales-report', array(
    'as' => 'report-product-sales', function () {
        return view('pages.reports.product-sale-report',array('submitted'=>false));
    }
));
Route::post('report/sales-report', array(
    'as' => 'post-report-product-sales', 'uses' => 'ReportController@postSalesReport'
));
// Product Sales Report
Route::get('report/invoices', array(
    'as' => 'report-invoices', function () {
        return view('pages.reports.invoices.index');
    }
));
Route::get('report/invoices/{id}', array(
    'as' => 'reports-view-invoice', 'uses' => 'ReportController@view_shipmentInvoice'
));
Route::post('report/invoices/{id}', array(
    'as' => 'post-generate-invoice', 'uses' => 'ReportController@post_generateInvoice'
));

Route::get('api/reports/shipment/list', array(
    'as' => 'api-report-list-shipment', 'uses' => 'ReportController@api_getShipmentList'
));
