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

Route::get('/', array(
    'as' => 'login',
    'uses' => 'UserController@login'
));

Route::group(array('prefix' => 'allowance'), function() {
    Route::get('/', array(
        'as' => 'allowance',
        'uses' => 'AllowanceController@view'
    ));

    Route::get('view/department/{id}/year/{year}/month/{month}/', array(
        'uses' => 'AllowanceController@viewTable'
    ));

    Route::get('download/department/{id}/year/{year}/month/{month}/', array(
        'uses' => 'AllowanceController@downloadTable'
    ));

    Route::get('manage', array(
        'uses' => 'AllowanceController@manage'
    ));

    Route::get('manage/department/{id}', array(
        'uses' => 'AllowanceController@manageDepartment'
    ));

    Route::put('manage', array(
        'uses' => 'AllowanceController@applyChange'
    ));
});

Route::group(array('prefix' => 'user'), function() {
    Route::get('edit', array(
        'uses' => 'UserController@edit'
    ));
    Route::post('/', array(
        'as' => 'account-sign-in-post',
        'uses' => 'UserController@postSignIn'
    ));
});

Route::group(array('prefix' => 'converter'), function() {
    Route::get('/', array('uses' => 'ConverterController@index'));
    Route::post('/', array('uses' => 'ConverterController@execute'));
    //Route::post('do_upload', 'ConverterController@execute');
});
