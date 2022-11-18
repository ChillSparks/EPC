<?php

Route::get('/', function () {
    return redirect('/admin/home');
});

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    // Permission Route
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    // Role Route
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    // User Route
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    // PO Contract Route
    Route::resource('pocontract', 'POContractController');
    Route::post('pocontract_mass_destroy', ['uses' => 'POContractController@massDestroy', 'as' => 'pocontract.mass_destroy']);
    // Do Item Manage Route
    Route::get('do-item/{do_item}', ['uses' => 'DOItemController@createItems', 'as' => 'doitems.create']);
    Route::post('do-item/store', ['uses' => 'DOItemController@store', 'as' => 'doitems.store']);
    Route::post('do-item/edit', ['uses' => 'DOItemController@edit', 'as' => 'doitems.edit']);
    Route::post('do-item/update', ['uses' => 'DOItemController@update', 'as' => 'doitems.update']);
    Route::DELETE('do-item/{destroy}',['uses' => 'DOItemController@destroy', 'as' => 'doitems.destroy']);
    // Route::post('do-item_mass_destroy', ['uses' => 'DOItemController@massDestroy', 'as' => 'do-items.mass_destroy']);
    // Unit Route
    Route::resource('unit', 'UnitController');
    Route::post('unit_mass_destroy', ['uses' => 'UnitController@massDestroy', 'as' => 'unit.mass_destroy']);
    // Supplier Route
    Route::resource('supplier', 'SupplierController');
    // Division Route
    Route::resource('division', 'DivisionController');
    // Township Route
    Route::resource('township', 'TownshipController');
    // Currency Route
    Route::resource('currency','CurrencyController');    

    // Checking 
    Route::get('check', ['uses' => 'POReceivedController@index', 'as' => 'check.index']);
    Route::get('check/list', ['uses' => 'POReceivedController@checkList', 'as' => 'check.formlist']);
    Route::get('check/editcheck/{editcheck}',['uses' => 'POReceivedController@editcheck', 'as' => 'check.editcheck']);
    Route::get('check/create', ['uses' => 'POReceivedController@create', 'as' => 'check.create']);
    Route::post('check', ['uses' => 'POReceivedController@store', 'as' => 'check.store']);
    Route::get('check/{check}', ['uses' => 'POReceivedController@show', 'as' => 'check.show']);
    Route::post('check/update',['uses' => 'POReceivedController@update', 'as' => 'check.update']);
    Route::delete('check/{delete}',['uses' => 'POReceivedController@destroy', 'as' => 'check.delete']);
    Route::get('printChecking/{id}', ['uses' => 'POReceivedController@printChecking', 'as' => 'check.printChecking']);
    Route::get('printForm16A/{id}',['uses' => 'POReceivedController@printForm16A', 'as' => 'check.printForm16A']);
    //To Check
    Route::get('tocheck/', ['uses' => 'ToCheckController@index', 'as' => 'tocheck.index']);
    Route::get('tocheck/confirm', ['uses' => 'ToCheckController@checkerConfrim', 'as' => 'tocheck.checker-comfirm']);
    Route::get('tocheck/items', ['uses' => 'ToCheckController@detail', 'as' => 'tocheck.item-details']);
    Route::post('tocheck/store', ['uses' => 'ToCheckController@store', 'as' => 'tocheck.store']);
    //to save storeCode
    Route::get('store-code', ['uses' => 'StoreCodeEntryController@index', 'as' => 'store-code.index']);
    Route::get('store-code/entry', ['uses' => 'StoreCodeEntryController@detail', 'as' => 'store-code.item-details']);
    Route::post('store-code', ['uses' => 'StoreCodeEntryController@store', 'as' => 'store-code.store']);
    Route::get('printGR/{id}', ['uses' => 'StoreCodeEntryController@printGR', 'as' => 'store-code.printGR']);
    //store Code
    Route::get('store', ['uses' => 'StoreController@index', 'as' => 'store.index']);
    Route::get('store/search', ['uses' => 'StoreController@search', 'as' => 'store.search']);
    Route::get('store/search/res', ['uses' => 'StoreController@stockSearch', 'as' => 'store.searchResult']);
    //stock 
    Route::get('stock/request', ['uses' => 'StockRequestController@stockRequest', 'as' => 'stock.request']);
    Route::get('request/create', ['uses' => 'StockRequestController@stockRequestCreate', 'as' => 'stock_request.create']);
    Route::get('request/township', ['uses' => 'StockRequestController@getTownshipList', 'as' => 'township']);
    Route::post('request/store', ['uses' => 'StockRequestController@stockRequestStore', 'as' => 'stock_request.store']);
    Route::get('request/{details}', ['uses' => 'StockRequestController@stockRequestDetails', 'as' => 'stock_request.detail']);
    Route::DELETE('request/{destroy}',['uses' => 'StockRequestController@destroy', 'as' => 'stock_request.destroy']);
    Route::get('printRequest/{id}',['uses' => 'StockRequestController@printRequest', 'as' => 'printRequest']);

    //Issue 
    Route::get('issue', ['uses' => 'StockIssueController@index', 'as' => 'stock_issue.index']);
    Route::get('issue/{create}', ['uses' => 'StockIssueController@create', 'as' => 'stock_issue.create']);
    Route::post('issue/store', ['uses' => 'StockIssueController@store', 'as' => 'stock_issue.store']);
    Route::get('issue/confirm/{confirm}', ['uses' => 'StockIssueController@confirmDetails', 'as' => 'issue.confirm']);
    Route::post('issue/stock', ['uses' => 'StockIssueController@stockIssue', 'as' => 'stock.issue']);
    Route::get('printIssue/{id}',['uses' => 'StockIssueController@printIssue', 'as' => 'issue.printIssue']);

    Route::PUT('issue-aproved/{approve}', ['uses' => 'StockIssueController@firstApproved', 'as' => 'stock_issue.confrimApproved']);
    Route::PUT('request-firstaproved/{approve}', ['uses' => 'StockRequestController@firstApproved', 'as' => 'stock_request.firstApproved']);
    Route::PUT('request-secondapproved/{approve}', ['uses' => 'StockRequestController@secondApproved', 'as' => 'stock_request.secondApproved']);

    //Approved
    Route::PUT('first-aproved/{approve}', ['uses' => 'ToCheckController@firstApproved', 'as' => 'tocheck.firstApproved']);
    Route::PUT('second-approved/{approve}', ['uses' => 'ToCheckController@secondApproved', 'as' => 'tocheck.secondApproved']);
});
Route::post('division_mass_destroy', ['uses' => 'DivisionController@massDestroy', 'as' => 'division.mass_destroy']);
Route::post('township_mass_destroy', ['uses' => 'TownshipController@massDestroy', 'as' => 'township.mass_destroy']);
Route::post('supplier_mass_destroy', ['uses' => 'SupplierController@massDestroy', 'as' => 'supplier.mass_destroy']);
// Route::post('check_mass_destroy', ['uses' => 'SupplierController@massDestroy', 'as' => 'supplier.mass_destroy']);
