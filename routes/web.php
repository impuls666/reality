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
Route::get('/', function ()
{
    return view('map');
});

Route::get('data', 'MarkerController@index');


Auth::routes();

Route::get('home', 'HomeController@index')->name('home');

Route::post('show', 'MarkerController@showlatlong')->name('show');

Route::post('store','MarkerController@store')->name('store');

