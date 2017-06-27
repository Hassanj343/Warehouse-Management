<?php
Route::get('/dashboard/trending-products/{range}', array(
    'as' => 'get-trending-products', 'uses' => 'MainController@get_trendingProducts'
));
Route::get('/dashboard/trending-products-chart/{range}', array(
    'as' => 'get-trending-products-chart', 'uses' => 'MainController@get_trendingProductsChart'
));
Route::get('/dashboard/product-stock-chart', array(
    'as' => 'get-product-stock-chart', 'uses' => 'MainController@get_productStockChart'
));
Route::get('/dashboard/sales-analytic/{range}', array(
    'as' => 'get-sales-analytic', 'uses' => 'MainController@get_salesAnalytic'
));
Route::get('/dashboard/dashboard-tiles', array(
    'as' => 'get-dashboard-tiles', 'uses' => 'MainController@get_dashboardTiles'
));