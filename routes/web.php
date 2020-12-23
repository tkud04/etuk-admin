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
Route::get('add-banner', 'MainController@getAddBanner');
Route::post('add-banner', 'MainController@postAddBanner');
Route::get('update-banner', 'MainController@getUpdateBanner');
Route::get('remove-banner', 'MainController@getRemoveBanner');

//Tickets
Route::get('tickets', 'MainController@getTickets');
Route::get('ticket', 'MainController@getTicket');
Route::get('add-ticket', 'MainController@getAddTicket');
Route::post('add-ticket', 'MainController@postAddTicket');
Route::get('update-ticket', 'MainController@getUpdateTicket');
Route::post('update-ticket', 'MainController@postUpdateTicket');
Route::get('remove-ticket', 'MainController@getRemoveTicket');

//Senders
Route::get('senders', 'MainController@getSenders');
Route::get('add-sender', 'MainController@getAddSender');
Route::post('add-sender', 'MainController@postAddSender');
Route::get('sender', 'MainController@getSender');
Route::post('sender', 'MainController@postSender');
Route::get('remove-sender', 'MainController@getRemoveSender');
Route::get('mark-sender', 'MainController@getMarkSender');

//FAQs
Route::get('faqs', 'MainController@getFAQs');
Route::get('add-faq', 'MainController@getAddFAQ');
Route::post('add-faq', 'MainController@postAddFAQ');
Route::get('faq', 'MainController@getUpdateFAQ');
Route::get('remove-faq', 'MainController@getRemoveFAQ');
Route::get('faq-tags', 'MainController@getFAQTags');
Route::get('add-faq-tag', 'MainController@getAddFAQTag');
Route::post('add-faq-tag', 'MainController@postAddFAQTag');
Route::get('remove-faq-tag', 'MainController@getRemoveFAQTag');

//Posts
Route::get('posts', 'MainController@getPosts');
Route::get('add-post', 'MainController@getAddPost');
Route::post('add-post', 'MainController@postAddPost');
Route::get('post', 'MainController@getUpdatePost');
Route::post('post', 'MainController@postUpdatePost');
Route::get('remove-post', 'MainController@getRemovePost');

//Reservation Logs
Route::get('respond-to-reservation', 'MainController@getRespondToReservation');

Route::get('zohoverify/{nn}', 'MainController@getZoho');
Route::get('tb', 'MainController@getTestBomb');

