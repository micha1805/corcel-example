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

Route::get('/', 'PagesController@showWelcome')
    ->name('welcome');

Route::get('/sample-page', 'PagesController@showSamplePage')
    ->name('sample-page');

Route::get('/messages/{message}', 'MessagesController@show')
    ->name('message');

Route::post('/messages/create', 'MessagesController@create')
    ->middleware('auth');

Auth::routes();
