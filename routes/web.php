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
    return view('auth/login');
});



Auth::routes();
//home/dashboard
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'DashBoardController@index')->name('dashboard');

//generate
Route::get('/generate', 'GenerateController@index')->name('generate');
Route::any('/generate/create', 'GenerateController@create')->name('generate.create');
Route::post('/generate/StoreFirst', 'GenerateController@StoreFirst')->name('generate.StoreFirst');
Route::post('/generate/StoreSecond', 'GenerateController@StoreSecond')->name('generate.StoreSecond');


//database
Route::get('/database', 'DataBaseController@index')->name('database');
Route::get('/database/view/{codes}','DataBaseController@view')->name('database.view');
Route::get('/database/download/{codes}','DataBaseController@download')->name('database.download');
Route::get('/database/delete/{id}','DataBaseController@delete')->name('database.delete');
Route::get('/database/update/{id}', 'DataBaseController@update')->name('database.update');

Route::get('/database/delete_all','DataBaseController@delete_all')->name('database.delete_all');



//others

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

