<?php

use Illuminate\Support\Facades\Route;

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
//  Auth::routes();
 Route::get('/getuser', 'UserController@index');
 Route::get('/create','UserController@create');
 Route::get('/task', 'UserController@index');
 Route::get('/edit/task/{id}','UserController@edit');
 Route::post('/edit/task/{id}','UserController@update');
 Route::delete('/delete/task/{id}','UserController@destroy');
