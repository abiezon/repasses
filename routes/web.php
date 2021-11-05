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
Route::resource('roles', 'RoleController')->middleware('auth');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/teachers', 'UserController@teachers')->name('teachers');
Route::get('/students', 'UserController@students')->name('students');
// Route::get('/roles', 'UserController@index')->name('users');

Route::resource('classrooms', 'ClassroomController')->middleware('auth');
Route::resource('groups', 'GroupController')->middleware('auth');
Route::resource('type-documents', 'TypeDocumentController')->middleware('auth');
Route::resource('launches', 'LaunchController')->middleware('auth');
Route::get('/classroom-students/{id}', 'ClassroomUserController@students')->name('classroom-students')->middleware('auth');
Route::resource('classroom-user', 'ClassroomUserController')->middleware('auth');
Route::get('/classroom-subjects/{id}', 'ClassroomController@subjects')->name('classroom-subjects')->middleware('auth');
Route::post('add-subjects', 'ClassroomController@add_subjects')->name('add-subjects')->middleware('auth');
Route::get('/school-report/{id}', 'GradeController@school_report')->name('school-report')->middleware('auth');
Route::get('/my-rooms/{id}', 'ClassroomController@my_rooms')->name('my-rooms')->middleware('auth');
Route::get('/my-schedule/{id}', 'ScheduleController@my_schedule')->name('my-schedule')->middleware('auth');