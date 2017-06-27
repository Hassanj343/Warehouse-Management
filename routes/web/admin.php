<?php
Route::group(['middleware' => 'administrator'], function () {
    Route::get('application/settings/general', array(
        'as' => 'settings-general', 'uses' => 'Application_Settings\GlobalSettingsController@index'
    ));

    Route::post('application/settings/general', array(
        'as' => 'post-settings-general', 'uses' => 'Application_Settings\GlobalSettingsController@update'
    ));

    Route::get('application/settings/users', array(
        'as' => 'settings-manage-users', 'uses' => 'Application_Settings\UsersController@index'
    ));

    Route::get('application/settings/users/create', array(
        'as' => 'settings-create-user', 'uses' => 'Application_Settings\UsersController@get_create'
    ));

    Route::post('application/settings/users/create', array(
        'as' => 'post-settings-create-user', 'uses' => 'Application_Settings\UsersController@post_create'
    ));

    Route::get('application/settings/users/delete/{id}', array(
        'as' => 'settings-delete-user', 'uses' => 'Application_Settings\UsersController@get_delete'
    ));

    Route::get('application/settings/users/modify/{id}', array(
        'as' => 'settings-update-user', 'uses' => 'Application_Settings\UsersController@get_update'
    ));

    Route::post('application/settings/users/modify/{id}', array(
        'as' => 'post-settings-update-user', 'uses' => 'Application_Settings\UsersController@post_update'
    ));
});