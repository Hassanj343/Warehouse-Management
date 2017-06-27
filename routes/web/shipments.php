<?php

Route::get('shipment', array(
    'as' => 'manage-shipments', 'uses' => 'ShipmentController@index'
));

Route::get('shipment/quick/create', array(
    'as' => 'create-quick-shipment', 'uses' => 'ShipmentController@get_quickCreate'
));
Route::get('shipment/quick-sell', array(
    'as' => 'shipment-quick-sell', 'uses' => 'ShipmentController@get_quickSell'
));
Route::post('shipment/quick-remove', array(
    'as' => 'shipment-quick-remove', 'uses' => 'ShipmentController@post_quickRemove'
));


Route::get('shipment/create', array(
    'as' => 'create-shipment', 'uses' => 'ShipmentController@get_create'
));
Route::post('shipment/create-shipment', array(
    'as' => 'shipment-create-shipment', 'uses' => 'ShipmentController@post_createShipment'
));
Route::post('shipment/store-shipment-products', array(
    'as' => 'shipment-store-product', 'uses' => 'ShipmentController@post_addShipmentProducts'
));
Route::get('shipment/removeProduct/{id}', array(
    'as' => 'shipment-remove-product', 'uses' => 'ShipmentController@get_removeShipmentProduct'
));


Route::get('shipment/modify/{id}', array(
    'as' => 'modify-shipment', 'uses' => 'ShipmentController@get_update'
));
Route::get('shipment/modify/{id}/products', array(
    'as' => 'modify-shipment-products', 'uses' => 'ShipmentController@get_update_products'
));
Route::post('shipment/modify/{id}', array(
    'as' => 'post-modify-shipment', 'uses' => 'ShipmentController@post_update'
));

Route::get('shipment/delete/{id}', array(
    'as' => 'delete-shipment', 'uses' => 'ShipmentController@get_destroy'
));
Route::get('shipment/delete/{id}/restock', array(
    'as' => 'delete-restock-shipment', 'uses' => 'ShipmentController@get_destroyRestock'
));

Route::get('shipment/view/{id}', array(
    'as' => 'view-shipment', 'uses' => 'ShipmentController@get_view'
));
// Api


Route::get('api/shipment/list', array(
    'as' => 'api-list-shipment', 'uses' => 'ShipmentController@api_getList'
));

Route::post('api/shipment/bulkDelete', array(
    'as' => 'api-bulk-delete-shipment', 'uses' => 'ShipmentController@api_bulkDelete'
));