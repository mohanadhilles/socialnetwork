<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');
Route::post('/home', 'PostController@store');
Route::post('/post', 'CommentController@store');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/profile={id}', 'PostController@getPosts');

Route::get('/profile={user_id}/posts/{post_id}', 'PostController@getPost');
Route::get('/posts/{post_id}', 'PostController@getMyPost');
Route::get('/deletepost={post_id}', 'PostController@deletPost');
