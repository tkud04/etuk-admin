<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'MainController@getIndex');
Route::get('temp', 'MainController@getTemp');

//Authentication
Route::get('signup', 'LoginController@getSignup');
Route::post('signup', 'LoginController@postSignup');
Route::get('forgot-password', 'LoginController@getForgotPassword');
Route::post('forgot-password', 'LoginController@postForgotPassword');
Route::get('reset', 'LoginController@getPasswordReset');
Route::post('reset', 'LoginController@postPasswordReset');
Route::get('hello', 'LoginController@getHello');
Route::post('hello', 'LoginController@postHello');
Route::get('bye', 'LoginController@getBye');
Route::get('oauth', 'LoginController@getOauth');
Route::get('{type}/oauth', 'LoginController@getOauthRedirect');
Route::get('oauth-sp', 'LoginController@getOAuthSP');
Route::post('oauth-sp', 'LoginController@postOAuthSP');

//Users
Route::get('users', 'MainController@getUsers');

Route::get('zohoverify/{nn}', 'MainController@getZoho');
Route::get('tb', 'MainController@getTestBomb');

