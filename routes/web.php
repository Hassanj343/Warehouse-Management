<?php
Route::group(['middleware' => 'guest'], function() {
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
	// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
	// Password Reset Routes...
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');
	Route::post('login', 'Auth\LoginController@login');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('/','MainController@homepage')->name('homepage');
    Route::get('/search','MainController@get_search')->name('post-search');

    // Products
    require __DIR__ . '/web/products.php';

    // Dashboard
    require __DIR__ . '/web/dashboard.php';

    // Shipments
    require __DIR__ . '/web/shipments.php';

    // Supplier
    require __DIR__ . '/web/supplier.php';

    // Customer
    require __DIR__ . '/web/customer.php';

    // Group
    require __DIR__ . '/web/group.php';

    // Admin Section
    require __DIR__ . '/web/admin.php';

    // Reporting
    require __DIR__ . '/web/report.php';

    // Export 
    require __DIR__ . '/web/export.php';
});

