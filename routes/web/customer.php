<?php

Route::get('customer', array(
    'as' => 'manage-customers', 'uses' => 'CustomerController@index'
));

Route::get('customer/create', array(
    'as' => 'create-customer', 'uses' => 'CustomerController@get_create'
));
Route::post('customer/create', array(
    'as' => 'post-create-customer', 'uses' => 'CustomerController@post_create'
));

Route::get('customer/modify/{id}', array(
    'as' => 'modify-customer', 'uses' => 'CustomerController@get_update'
));
Route::post('customer/modify/{id}', array(
    'as' => 'post-modify-customer', 'uses' => 'CustomerController@post_update'
));

Route::get('customer/delete/{id}', array(
    'as' => 'delete-customer', 'uses' => 'CustomerController@get_destroy'
));
Route::get('customer/view/{id}', array(
    'as' => 'view-customer', 'uses' => 'CustomerController@get_view'
));

// Api

Route::get('api/customer/list', array(
    'as' => 'api-list-customer', 'uses' => 'CustomerController@api_getList'
));

Route::post('api/customer/bulkDelete', array(
    'as' => 'api-bulk-delete-customer', 'uses' => 'CustomerController@api_bulkDelete'
));