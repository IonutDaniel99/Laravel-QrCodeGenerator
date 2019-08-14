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

//first 
Auth::routes();

//after
Auth::routes(['verify' => true]);

//home/dashboard
Route::any('/dashboard', 'DashBoardController@index')->name('dashboard')->middleware('verified');;
Route::post('/dashboard', 'DashBoardController@settings')->name('dashboard.settings');
Route::get('/dashboard/FirstChartJson', 'RefreshController@FirstChart')->name('FirstChart');
Route::get('/dashboard/ThirdChartJson', 'RefreshController@ThirdChart')->name('ThirdChart');
Route::get('/dashboard/refresh', 'RefreshController@index')->name('JsonRefresh');




//generate
Route::get('/generate', 'GenerateController@index')->name('generate');
Route::any('/generate/create', 'GenerateController@create')->name('generate.create');
Route::post('/generate/StoreFirst', 'GenerateController@StoreFirst')->name('generate.StoreFirst');
Route::post('/generate/StoreSecond', 'GenerateController@StoreSecond')->name('generate.StoreSecond');


//database
Route::get('/database', 'DataBaseController@index')->name('database');
Route::get('/database/view/{codes}', 'DataBaseController@view')->name('database.view');
Route::get('/database/download/{codes}', 'DataBaseController@download')->name('database.download');
Route::get('/database/delete/{id}', 'DataBaseController@delete')->name('database.delete');
Route::get('/database/update/{id}', 'DataBaseController@update')->name('database.update');

Route::get('/database/delete_all', 'DataBaseController@delete_all')->name('database.delete_all');

//User Database
Route::get('/users', 'UsersController@index')->name('users.index');
Route::get('/users/create', 'UsersController@create')->name('users.create');
Route::POST('/users', 'UsersController@store')->name('users.store');
Route::get('/users/{id}', 'UsersController@show')->name('users.show');
Route::get('/users/{id}/edit', 'UsersController@edit')->name('users.edit');
Route::post('/users/{id}', 'UsersController@update')->name('users.update');
Route::get('/users/delete/{id}', 'UsersController@destroy')->name('users.destroy');


//others

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
