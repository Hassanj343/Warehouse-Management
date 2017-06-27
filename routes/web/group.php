<?php
Route::get('group', array(
    'as' => 'manage-groups', 'uses' => 'GroupController@index'
));

Route::get('group/create', array(
    'as' => 'create-group', 'uses' => 'GroupController@get_create'
));
Route::post('group/create', array(
    'as' => 'post-create-group', 'uses' => 'GroupController@post_create'
));

Route::get('group/modify/{id}', array(
    'as' => 'modify-group', 'uses' => 'GroupController@get_update'
));
Route::post('group/modify/{id}', array(
    'as' => 'post-modify-group', 'uses' => 'GroupController@post_update'
));

Route::get('group/add/product/{gid}/{pid}', array(
    'as' => 'group-add-product', 'uses' => 'GroupController@get_addProduct'
));

Route::get('group/delete/product/{id}', array(
    'as' => 'group-remove-product', 'uses' => 'GroupController@get_deleteProduct'
));

Route::get('group/delete/{id}', array(
    'as' => 'delete-group', 'uses' => 'GroupController@get_destroy'
));
Route::get('group/view/{id}', array(
    'as' => 'view-group', 'uses' => 'GroupController@get_view'
));


/*
 * Api
 */

Route::get('api/group/list', array(
    'as' => 'api-list-group', 'uses' => 'GroupController@api_getList'
));

Route::get('api/group/list/products/{gid}', array(
    'as' => 'api-list-group-products', 'uses' => 'GroupController@api_getListProducts'
));

Route::post('api/group/bulkDelete', array(
    'as' => 'api-bulk-delete-group', 'uses' => 'GroupController@api_bulkDelete'
));