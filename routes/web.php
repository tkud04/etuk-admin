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
Route::get('user', 'MainController@getUser');
Route::post('user', 'MainController@postUser');
Route::get('edu', 'MainController@getEnableDisableUser');

//Reviews
Route::get('reviews', 'MainController@getReviews');
Route::get('arr', 'MainController@getApproveRejectReview');
Route::get('dr', 'MainController@getRemoveReview');

//Permissions
Route::get('add-permissions', 'MainController@getAddPermission');
Route::post('add-permissions', 'MainController@postAddPermission');
Route::get('remove-permission', 'MainController@getRemovePermission');

//Transactions
Route::get('transactions', 'MainController@getTransactions');
Route::get('transaction', 'MainController@getTransaction');

//Plugins
Route::get('plugins', 'MainController@getPlugins');
Route::get('add-plugin', 'MainController@getAddPlugin');
Route::post('add-plugin', 'MainController@postAddPlugin');
Route::get('plugin', 'MainController@getPlugin');
Route::post('plugin', 'MainController@postPlugin');
Route::get('remove-plugin', 'MainController@getRemovePlugin');

//Banners
Route::get('banners', 'MainController@getBanners');
Route::get('add-banner', 'MainController@getAddPlugin');
Route::get('banner', 'MainController@getUpdateBanner');
Route::get('remove-banner', 'MainController@getRemoveBanner');

//Tickets
Route::get('tickets', 'MainController@getTickets');
Route::get('ticket', 'MainController@getTicket');
Route::get('add-ticket', 'MainController@getAddTicket');
Route::post('add-ticket', 'MainController@postAddTicket');
Route::get('update-ticket', 'MainController@getUpdateTicket');
Route::post('update-ticket', 'MainController@postUpdateTicket');
Route::get('remove-ticket', 'MainController@getRemoveTicket');

Route::get('zohoverify/{nn}', 'MainController@getZoho');
Route::get('tb', 'MainController@getTestBomb');

