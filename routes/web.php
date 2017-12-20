<?php

use App\Student;


Route::get('/', 'PagesController@index');

Route::resource('college', 'CollegeController');

Route::resource('department', 'DepartmentController');

Route::resource('college.department', 'CollegeDepartmentController');

Route::resource('program', 'ProgramController');

Route::resource('student', 'StudentController');

Route::get('/student/{slug}/deficiencies', function($slug){
	return Student::whereSlug($slug)->firstOrFail()->deficiencies->paginate(10);

});

Route::resource('staff', 'StaffController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
