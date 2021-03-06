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

//Route::get('/','MarkerController@index');
//return view('welcome');
//dd(\App\Marker::all()->toArray());

Route::get('/', function () {
    return view('map', ['price' => '']);
});



Route::post('/', 'FilterController@change')->name('filter');

Route::get('data', 'MarkerController@index');

Route::get('data/{price}', 'FilterController@show');

Auth::routes();

Route::get('post/{id}', 'Postcontroller@show')->name('post');


Route::get('home', 'HomeController@index')->name('home');

Route::post('show', 'MarkerController@showlatlong')->name('show');

Route::post('store','MarkerController@store')->name('store');

