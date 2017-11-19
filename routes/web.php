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

Route::get('/', 'PagesController@index');

Route::resource('college', 'CollegeController');

Route::resource('department', 'DepartmentController');

Route::resource('program', 'ProgramController');

Route::resource('student', 'StudentController');

Route::resource('staff', 'StaffController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
