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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/product', 'ProductController@index');
Route::get('product/edit/{id}', 'ProductController@edit');
//Like route
Route::get('post','PostController@index');
Route::get('post/{slug?}','PostController@show')->name('post');
Route::post('/like','PostController@getlike');
Route::post('/like/{id}','PostController@like');


//Route::get('/{any}', 'SpaController@index')->where('any', '.*');
