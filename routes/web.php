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

//* Authentication routes
Auth::routes();

//* Facebook authentication routes
Route::get('/auth/facebook', 'SocialAuthController@facebook');
Route::get('/auth/facebook/callback', 'SocialAuthController@callback');
Route::post('/auth/facebook/register', 'SocialAuthController@register');

//* Routes that need authentication
Route::group(['middleware' => 'auth'], function () {
    Route::get('/conversations/{conversation}', 'ConversationController@showConversation');
    Route::post('/message/create', 'MessageController@create');
    Route::post('/user/{username}/dms', 'UserController@sendPrivateMessage');
    Route::post('/user/{username}/follow', 'UserController@follow');
    Route::post('/user/{username}/unfollow', 'UserController@unfollow');
});

//* Pages routes
Route::get('/', 'PageController@showWelcome')
    ->name('welcome');
Route::get('/sample-page', 'PageController@showSamplePage')
    ->name('sample-page');

//* Messages routes
Route::get('/message/{message}', 'MessageController@show');

//* User routes
Route::get('/user/{username}', 'UserController@showProfile');
Route::get('/user/{username}/follows', 'UserController@showFollows');
Route::get('/user/{username}/followers', 'UserController@showFollowers');
