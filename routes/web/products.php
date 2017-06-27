<?php

Route::get('products', array(
    'as' => 'manage-products', 'uses' => 'ProductsController@index'
));

Route::get('products/create', array(
    'as' => 'create-product', 'uses' => 'ProductsController@get_create'
));
Route::post('products/create', array(
    'as' => 'post-create-product', 'uses' => 'ProductsController@post_create'
));

Route::get('products/modify/{id}', array(
    'as' => 'modify-product', 'uses' => 'ProductsController@get_update'
));
Route::post('products/modify/{id}', array(
    'as' => 'post-modify-product', 'uses' => 'ProductsController@post_update'
));

Route::get('products/view/{id}', array(
    'as' => 'view-product', 'uses' => 'ProductsController@get_view'
));

Route::get('products/delete/{id}', array(
    'as' => 'delete-product', 'uses' => 'ProductsController@get_destroy'
));

Route::get('products/stock-in/{id}', array(
    'as' => 'stock-in-product', 'uses' => 'ProductsController@get_stockIn'
));
Route::post('products/stock-in/{id}', array(
    'as' => 'post-stock-in-product', 'uses' => 'ProductsController@post_stockIn'
));

Route::get('products/stock-out/{id}', array(
    'as' => 'stock-out-product', 'uses' => 'ProductsController@get_stockOut'
));
Route::post('products/stock-out/{id}', array(
    'as' => 'post-stock-out-product', 'uses' => 'ProductsController@post_stockOut'
));

Route::get('api/products/search/{barcode}', array(
    'as' => 'search-product', 'uses' => 'ProductsController@get_search'
));

Route::get('api/products/search-product', array(
    'as' => 'search-product', 'uses' => 'ProductsController@get_search_products'
));


// Api
Route::get('api/products/list', array(
    'as' => 'api-list-products', 'uses' => 'ProductsController@api_getList'
));
Route::post('api/product/bulkDelete', array(
    'as' => 'api-bulk-delete-product', 'uses' => 'ProductsController@api_bulkDelete'
));

Route::get('api/alerts/products/stock', array(
    'as' => 'api-alert-product-stock', 'uses' => 'ProductsController@api_getStockAlert'
));
