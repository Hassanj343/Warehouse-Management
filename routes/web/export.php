<?php

Route::group(['prefix' => 'export'],function(){

    Route::get('products',[
        'as' => 'export-products',
        'uses' => 'ExportController@getExportProducts'
    ]);

    Route::post('products/post',[
        'as' => 'post-export-products',
        'uses' => 'ExportController@postExportProducts'
    ]);

});