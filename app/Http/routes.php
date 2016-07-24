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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', 'UserController');
Route::resource('books', 'BookController');

Route::group(['middleware'=>'web'],function () {
      Route::get('/book/{bookid}/user/{userid}/take/',"AddController@takeBook");
      Route::get('/book/{bookid}/user/{userid}/return',"AddController@returnBook"); 
  });