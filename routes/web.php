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

Route::get('/', 'HomeController@index')->name('home')->middleware('auth');

Route::resource('users', 'UserController')->middleware('auth');
Route::resource('roles', 'RoleController')->middleware('can:isSuperAdmin');
Route::resource('groups', 'GroupController')->middleware('can:isAdmin');
Route::resource('type-documents', 'TypeDocumentController')->middleware('can:isAdmin');
Route::resource('launches', 'LaunchController')->middleware('auth');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/users/create', 'UserController@create')->middleware('can:isAdmin')->name('users.create');
Route::get('/users', 'UserController@index')->middleware('can:isAdmin')->name('users.index');
Route::get('/users/{id}', 'UserController@show')->middleware('auth')->name('users.show');
// Route::get('/launches', 'LaunchController@index')->middleware('auth')->name('launches.index');
// Route::get('/launches/{id}', 'LaunchController@show')->middleware('auth')->name('launches.show');
// Route::get('/launches/edit/{id}', 'LaunchController@edit')->middleware('can:isSuperAdmin')->name('launches.edit');
// Route::get('/launches/create', 'LaunchController@create')->middleware('can:isAdmin')->name('launches.create');
// Route::get('/launches/destroy', 'LaunchController@destroy')->middleware('can:isAdmin')->name('launches.destroy');


