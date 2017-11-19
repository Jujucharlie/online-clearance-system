<?php


Route::get('/', 'PagesController@index');

Route::resource('college', 'CollegeController');

Route::resource('department', 'DepartmentController');

Route::resource('program', 'ProgramController');

Route::resource('student', 'StudentController');

Route::resource('staff', 'StaffController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
