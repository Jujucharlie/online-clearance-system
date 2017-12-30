<?php

Route::get('/', 'PagesController@index');

Route::get('/profile', 'PagesController@profile');

Route::resource('college', 'CollegeController');

Route::resource('department', 'DepartmentController');

Route::resource('college.department', 'CollegeDepartmentController');

Route::resource('program', 'ProgramController');

Route::resource('student', 'StudentController');

Route::resource('staff', 'StaffController');

Route::resource('deficiency', 'DeficiencyController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
