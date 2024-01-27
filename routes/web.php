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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts','PostsController');
Route::post('posts/changeStatus', array('as' => 'changeStatus', 'uses' => 'PostsController@changeStatus'));
Auth::routes();

Route::get('/logout', 'Auth\AuthController@getLogout');

Route::get('/home', 'HomeController@index');
