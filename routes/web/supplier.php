<?php

Route::get('supplier', array(
    'as' => 'manage-suppliers', 'uses' => 'SupplierController@index'
));

Route::get('supplier/create', array(
    'as' => 'create-supplier', 'uses' => 'SupplierController@get_create'
));
Route::post('supplier/create', array(
    'as' => 'post-create-supplier', 'uses' => 'SupplierController@post_create'
));

Route::get('supplier/modify/{id}', array(
    'as' => 'modify-supplier', 'uses' => 'SupplierController@get_update'
));
Route::post('supplier/modify/{id}', array(
    'as' => 'post-modify-supplier', 'uses' => 'SupplierController@post_update'
));

Route::get('supplier/delete/{id}', array(
    'as' => 'delete-supplier', 'uses' => 'SupplierController@get_destroy'
));

Route::get('supplier/view/{id}', array(
    'as' => 'view-supplier', 'uses' => 'SupplierController@get_view'
));

// Api

Route::get('api/supplier/list', array(
    'as' => 'api-list-supplier', 'uses' => 'SupplierController@api_getList'
));

Route::post('api/supplier/bulkDelete', array(
    'as' => 'api-bulk-delete-supplier', 'uses' => 'SupplierController@api_bulkDelete'
));