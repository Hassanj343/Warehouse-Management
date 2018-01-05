<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['as' => 'api.'], function () {

// Group Api
    Route::group(['as' => 'group.', 'prefix' => 'group'], function () {
        Route::get("list", "Api\GroupController@list")->name('list');
        Route::get("list/products/{gid}", "Api\GroupController@alListProduct")->name('list-products');
        Route::get("bulk-delete", "Api\GroupController@bulkDelete")->name('bulk-delete');
    });

// Supplier Api
    Route::group(['as' => 'supplier.', 'prefix' => 'supplier'], function () {
        Route::get('list', 'Api\SupplierController@list')->name('list');
        Route::post('bulk-delete', 'Api\SupplierController@bulkDelete')->name('bulk-delete');
    });

// Customer Api
    Route::group(['as' => 'customer.', 'prefix' => 'customer'], function () {
        Route::get('list', 'Api\CustomerController@List')->name('list');
        Route::post('bulk-delete', 'Api\CustomerController@bulk-delete')->name('bulk-delete');
    });

});

