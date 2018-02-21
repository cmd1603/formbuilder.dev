<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::any('login', ['as' => 'auth.login', 'uses' => 'UserController@login']);

Route::any('auth/do_login', ['as' => 'auth.do_ login', 'uses' => 'UserController@do_login']);
Route::any('logout', ['as' => 'auth.logout' , 'uses' => 'UserController@logout']);
Route::get('/', 'UserController@home');
Route::get('latest', 'PagesController@latest');
Route::get('dev', 'PagesController@dev');
Route::get('users/{user}', 'UserController@show');
Route::get('users/{user}/edit', 'UserController@edit');
Route::put('users/{user}', 'UserController@update');
Route::delete('users/{user}', 'UserController@destroy');

// ----------------------- AJAX REQUEST ROUTES ------------------------- //
Route::get('/findProductName', 'RulesController@findProductName');
Route::get('/fetchRuleIds', 'RulesController@fetchRuleIds');
Route::get('/getRulesData', 'RulesController@getRulesData');
Route::post('/deleteRecordAjax', 'RulesController@deleteRecordAjax');
Route::post('/updateThroughAjax', 'RulesController@updateThroughAjax');
Route::post('/storeByAjax', 'RuleIdsController@storeByAjax');
Route::post('/editItem', 'RulesController@editItem');
Route::get('/getDistributorData', 'ProductAccessController@getDistributorData');
Route::get('/fetchDistributorData', 'ProductAccessController@fetchDistributorData');
Route::get('/fetchSalesPeopleData', 'SalesPersonController@fetchSalesPeopleData');
Route::post('/createDistAccessAjax', 'ProductAccessController@createDistAccessAjax');
Route::post('/deleteDistAccess', 'ProductAccessController@deleteDistAccess');
Route::post('/deleteSalesPerson', 'SalesPersonController@deleteSalesPerson');

// ----------------------- AUTH LEVEL ROUTES ------------------------- //
Route::group(['middleware' =>['auth']], function() {
	
	// ----------------------- ADMIN ONLY LEVEL ROUTES ------------------------- //
	Route::group(['middleware' => 'roles', 'roles' => 'Admin'], function() {
		Route::get('productaccess/create', 'ProductAccessController@create');
		Route::get('sfpc_access', ['as' => 'sfpc_access', 'uses' => 'ProductAccessController@sfpc_access']);
		Route::get('admin', ['as' => 'auth.admin', 'uses' => 'PagesController@adminPage']);
	    Route::post('admin/assign-roles', ['as' => 'auth.admin.assign', 'uses' => 'PagesController@postAdminAssignRoles']);	
	});

	// ----------------------- ADMIN & AUTHOR LEVEL ROUTES ------------------------- //
	Route::group(['middleware' => 'roles', 'roles' => ['Author', 'Admin']], function() {
		Route::any('creater', ['as' => 'auth.creater', 'uses' => 'PagesController@creater']);
		Route::any('dashboard', ['as' => 'auth.dashboard', 'uses' => 'UserController@dashboard']);
		Route::any('cutting_tech nologies', ['as' => 'auth.cutting_technologies', 'uses' => 'PagesController@cutting_technologies']);
		Route::get('router', ['as' => 'auth.router', 'uses' => 'PagesController@router']);
		Route::get('fabrication', ['as' => 'auth.fabrication', 'uses' => 'PagesController@fabrication']);
		Route::get('digital_finishing', ['as' => 'auth.digital_finishing', 'uses' => 'PagesController@digital_finishing']);
		Route::post('deactivate/configurations/{id}', 'ConfigurationsController@deactivate');
		Route::resource('configurations', 'ConfigurationsController');
		Route::resource('distributors', 'DistributorsController');
		Route::get('productaccess', ['as' => 'productaccess', 'uses' => 'ProductAccessController@index']);
		Route::get('productaccess/{id}/edit', ['middleware' => 'admin', 'uses' => 'ProductAccessController@edit']);
		Route::get('productaccess/{id}', ['uses' => 'ProductAccessController@show']);
		Route::post('productaccess', ['uses' => 'ProductAccessController@store']);
		Route::patch('productaccess/{id}', ['uses' => 'ProductAccessController@update']);
		Route::delete('productaccess/{id}', ['uses' => 'ProductAccessController@destroy']);
		Route::resource('rules', 'RulesController');
		Route::resource('rule_ids', 'RuleIdsController');
		Route::resource('sales_people', 'SalesPersonController');
		Route::resource('salesforce_product_codes', 'SalesforceProductCodesController');
		Route::resource('templates', 'TemplatesController');
	});	

	Route::any('order_forms', ['as' => 'auth.order_forms', 'uses' => 'UserController@order_forms']);
	Route::any('logout', ['as' => 'auth.logout' , 'uses' => 'UserController@logout']);
	
});

Route::auth();