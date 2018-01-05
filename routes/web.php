<?php
Route::group(['middleware' => 'guest'], function() {
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
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
    // Dashboard
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
    // Shipments

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
    // Supplier
        
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

    // Customer

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
    // Group
    
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
    // Admin Section
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
    // Reporting
    Route::get('report/product-report', array(
        'as' => 'reports-view-products', function () {
            return view('pages.reports.products-report');
        }
    ));
    Route::get('report/products/list', array(
        'as' => 'report-list-products', 'uses' => 'ReportController@list_products'
    ));

    // Stock Alerts Levels
    Route::get('report/stock-alert/{id}', array(
        'as' => 'report-stock-alert', function ($id) {
            return view('pages.reports.stock-alert',compact('id'));
        }
    ));
    Route::get('report/stock-alert/{level}/products', array(
        'as' => 'report-stock-alert-products', 'uses' => 'ReportController@list_stockAlertProducts'
    ));

    // Group Stock Alerts
    Route::get('report/group-stock-alert', array(
        'as' => 'report-group-stock', function () {
            return view('pages.reports.group-stock-report');
        }
    ));

    Route::get('report/group-stock-alert/{id}', array(
        'as' => 'report-group-stock-products', 'uses' => 'ReportController@list_groupProducts'
    ));

    // Product Out Of stock
    Route::get('report/product-out-of-stock/products', array(
        'as' => 'report-product-out-stock', function () {
            return view('pages.reports.product-out-stock');
        }
    ));
    Route::get('report/report-product-out-of-stock/products', array(
        'as' => 'report-product-out-stock-products', 'uses' => 'ReportController@list_outOfStockProducts'
    ));

    // Product Sales Report
    Route::get('report/sales-report', array(
        'as' => 'report-product-sales', function () {
            return view('pages.reports.product-sale-report',array('submitted'=>false));
        }
    ));
    Route::post('report/sales-report', array(
        'as' => 'post-report-product-sales', 'uses' => 'ReportController@postSalesReport'
    ));
    // Product Sales Report
    Route::get('report/invoices', array(
        'as' => 'report-invoices', function () {
            return view('pages.reports.invoices.index');
        }
    ));
    Route::get('report/invoices/{id}', array(
        'as' => 'reports-view-invoice', 'uses' => 'ReportController@view_shipmentInvoice'
    ));
    Route::post('report/invoices/{id}', array(
        'as' => 'post-generate-invoice', 'uses' => 'ReportController@post_generateInvoice'
    ));

    Route::get('api/reports/shipment/list', array(
        'as' => 'api-report-list-shipment', 'uses' => 'ReportController@api_getShipmentList'
    ));

    // Export 
    
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
});

