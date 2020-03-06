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
Route::get('index','ProgramController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('redirect/{driver}', 'Auth\LoginController@redirectToProvider')->name('login.provider');
Route::get('{driver}/callback', 'Auth\LoginController@handleProviderCallback')->name('login.callback');

Route::get('/redirect/{facebook}', 'Auth\LoginController@redirectToProviders')->name('loginn.providers');
Route::get('{facebook}/callback', 'Auth\LoginController@handleProviderCallbacks')->name('loginn.callbacks');;

Route::get('page/getcity', 'PageController@getcity');
Route::get('page/getprovince', 'PageController@getprovince');
// Route::get('page/checkshipping','PageController@checkshipping');
Route::get('page/checkshipping','PageController@checkShipping');
Route::post('page/processShipping', 'PageController@processShipping');
