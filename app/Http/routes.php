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
Route::get('/','PostsController@index');
//Route::get('/',function(){
//    $billing = app('billing');
//    dd($billing);
//});
Route::resource('discussions','PostsController');
Route::resource('comments','CommentsController');
Route::get('/user/register','UsersController@register');
Route::post('/user/register','UsersController@store');
Route::get('/verify/{confirm_code}','UsersController@confirmEmail');
Route::get('/user/login','UsersController@login');
Route::post('/user/login','UsersController@signin');
Route::get('/user/logout','UsersController@logout');
Route::get('/test','UsersController@test');
Route::get('/user/getImage','UsersController@getImage');
Route::post('/user/changeImage','UsersController@changeImage');
Route::post('/crop/api','UsersController@cropImage');
Route::post('/post/upload','PostsController@upload');
$a = 'k';