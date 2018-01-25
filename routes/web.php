<?php

Route::get('/', 'PagesController@index')->name('index');

Route::get('/profile', 'PagesController@profile')->name('profile');

Route::get('/about', 'PagesController@about')->name('about');

Route::resource('college', 'CollegeController');

Route::resource('department', 'DepartmentController');

Route::resource('college.department', 'CollegeDepartmentController');

Route::resource('program', 'ProgramController');

Route::resource('student', 'StudentController');

Route::resource('staff', 'StaffController');

Route::resource('deficiency', 'DeficiencyController');

Route::patch('deficiency/{deficiency}/complete', 'DeficiencyController@complete');

Route::resource('student.deficiency', 'StudentDeficiencyController');

Route::get('student/{student}/pdf', 'StudentController@pdf');

Route::get('search', 'PagesController@search')->name('autocomplete');

Auth::routes();

Route::get('home', function(){
	return redirect('/profile');
})->name('home');

Route::get('logs', 'PagesController@logs');

Route::get('log', 'PagesController@log');

Route::get('google', 'PagesController@google');

Route::get('glogin', 'PagesController@googleLogin')->name('glogin');
