<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
/*Route::pattern('id', '[0-9]+');
Route::pattern('year', '[1-2][0-9][0-9][0-9]');
Route::pattern('month', '[1]?[0-9]');

Route::get('/', function()
{
	return View::make('hello');
});

Route::group(array('prefix' => 'absensi'), function(){

	Route::get('/', array('uses' => 'AttendanceController@index'));
		
	Route::get('/department/{id}/year/{year}/month/{month}/', array('uses' => 'AttendanceController@showTable'));
});
*/


//Route::get('absensi', array('uses' => 'AttendanceController@index'));

//Route::get('absensi/{year}/{month}', function($year, $month){

//})->where(array('year' => '[0-9]+', 'month' => '[1-2][0-9]'));

Route::get('/', array(
	'as' => 'index',
	'uses' => 'IndexController@index'
));

Route::get('/manageAllowance', array(
	'as' => 'manage-allowance',
	'uses' => 'IndexController@manageAllowance'
));

Route::get('/manageUser', array(
	'as' => 'manage-user',
	'uses' => 'IndexController@manageUser'
));

Route::get('/convertDocument', array(
	'as' => 'convert-document',
	'uses' => 'IndexController@convertDocument'
));

Route::get('/editProfile', array(
	'as' => 'edit-profile',
	'uses' => 'IndexController@editProfile'
));

Route::get('/login', array(
	'as' => 'login',
	'uses' => 'IndexController@showLogin'
));

/*Route::get('/allowance', array(
		'as' => 'allowance',
		'uses' => 'IndexController@allowance'
));
*/
