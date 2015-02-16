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
Route::pattern('id', '[0-9]+');
Route::pattern('year', '[1-2][0-9][0-9][0-9]');
Route::pattern('month', '[1]?[0-9]');

Route::group(array('before' => 'guest'), function() {
    /*
      CSRF protection group
     */
    Route::group(array('before' => 'csrf'), function() {
        /*
          Sign in (POST)
         */
        Route::post('/signIn', array(
            'as' => 'account-sign-in-post',
            'uses' => 'UserController@postSignIn'
        ));
    });

    /*
      Sign in (GET)
     */
    Route::get('/', array(
        'uses' => 'UserController@login'
    ));
});

Route::get('/', function() {
	File::put(public_path() . "/js/url.js", "var url=\"".url()."/\"; ");//tulis url ke file, file tsb digunakan utk komunikasi dgn js 
    if (Auth::check()) {
        return View::make('layouts.dashboard');
    } else {
        return View::make('users.login');
    }
});

Route::get('/dashboard', array(
    'before' => 'auth',
    'as' => 'dashboard',
    'uses' => 'UserController@getDashboard'
));

Route::group(array('before' => 'auth', 'prefix' => 'allowance'), function() {

    Route::get('/', array(
        'uses' => 'AllowanceController@view'
    ));

    Route::get('view/department/{id}/year/{year}/month/{month}/', array(
        'uses' => 'AllowanceController@viewTable'
    ));

    Route::get('download/department/{id}/year/{year}/month/{month}/', array(
        'uses' => 'AllowanceController@downloadTable'
    ));

    Route::get('manage', array(
        'before' => 'roleManageAllowance',
        'uses' => 'AllowanceController@manage'
    ));

    Route::get('manage/category/{id}', array(
        'uses' => 'AllowanceController@manageAllowance'
    ));

    Route::put('manage', array(
        'uses' => 'AllowanceController@applyChange'
    ));
});

Route::group(array('before' => 'auth', 'prefix' => 'user'), function() {

    Route::get('manage', array('before' => 'roleManageUser', 'uses' => 'UserController@manage'));

    Route::get('manage/role/{id}', array('uses' => 'UserController@manageRole'));

    Route::post('add', array('uses' => 'UserController@add'));

    Route::put('update', array('uses' => 'UserController@update'));

    Route::delete('delete', array('uses' => 'UserController@remove'));

    Route::get('edit', array('uses' => 'UserController@editPassword'));

    Route::post('edit', array('uses' => 'UserController@savePassword'));
});

Route::group(array('before' => 'auth', 'prefix' => 'converter'), function() {

    Route::get('/', array('before' => 'roleConverter', 'uses' => 'ConverterController@index'));

    Route::post('upload', array('uses' => 'ConverterController@upload'));

    Route::post('convert', array('uses' => 'ConverterController@convert'));
});

Route::get('/signOut', array(
    'before' => 'auth',
    'as' => 'account-sign-out',
    'uses' => 'UserController@getSignOut'
));

Route::get('/forbidden', function() {
    return View::make('layouts.forbidden');
});
