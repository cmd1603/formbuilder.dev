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
Route::get('order_forms', 'PagesController@order_forms');
Route::get('about', ['as' => 'about', 'uses' => 'UserController@about']);
Route::get('users/{user}', 'UserController@show');
Route::get('users/{user}/edit', 'UserController@edit');
Route::put('users/{user}', 'UserController@update');
Route::delete('users/{user}', 'UserController@destroy');

Route::get('orm-test', function () 
{
	$rules = \App\Rule::all();
	return $rules;
});

Route::get('/findProductName', 'RulesController@findProductName');
Route::get('/getRulesData', 'RulesController@getRulesData');

Route::group(['middleware' =>['auth']], function ()
{
	Route::any('dashboard', ['as' => 'auth.dashboard', 'uses' => 'UserController@dashboard']);
	Route::any('creater', ['as' => 'auth.creater', 'uses' => 'UserController@creater']);
	Route::post('deactivate/configurations/{id}', 'ConfigurationsController@deactivate');
	Route::resource('configurations', 'ConfigurationsController');
	Route::resource('rules', 'RulesController');
	Route::any('order_forms', ['as' => 'auth.order_forms', 'uses' => 'UserController@order_forms']);
	Route::any('logout', ['as' => 'auth.logout' , 'uses' => 'UserController@logout']);
});

Route::auth();

