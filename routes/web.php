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

Route::patch('deficiency/{deficiency}/complete', 'DeficiencyController@complete');

Route::resource('student.deficiency', 'StudentDeficiencyController');

Route::get('student/{student}/pdf', 'StudentController@pdf');

Auth::routes();

Route::get('/home', function(){
	return redirect('/profile');
})->name('home');

Route::get('/logs', 'PagesController@logs');

Route::get('/log', function(){
	return redirect('/logs');
});
