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
Route::get('/', 'HomeController@index')->name('home');

Route::get('/opdracht/{id}', 'HomeController@showOpdracht')->name('opdracht');

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/backend', 'BackendController@index')->name('user_home');
Route::post('/backend/intro/save', 'BackendController@saveIntro')->name('user_intro_save');

Route::get('/backend/about', 'BackendController@showAbout')->name('user_about');
Route::post('/backend/about/save', 'BackendController@saveAbout')->name('user_about_save');

Route::get('/backend/opdrachten', 'BackendController@showOpdrachten')->name('user_opdrachten');
Route::get('/backend/opdrachten/new', 'BackendController@OpdrachtenCreate')->name('user_opdrachten_create');

Route::post('/backend/opdrachten/new/save', 'BackendController@OpdrachtenCreateSave')->name('user_opdrachten_create_save');
Route::post('/backend/opdrachten/save/{id}', 'BackendController@OpdrachtenSave')->name('user_opdrachten_save');
Route::post('/backend/opdrachten/upload/{id}', 'BackendController@OpdrachtenUpload')->name('user_opdrachten_upload');
Route::get('/backend/opdrachten/delete/{id}', 'BackendController@OpdrachtenDelete')->name('user_opdrachten_delete');
