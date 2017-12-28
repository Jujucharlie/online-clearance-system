<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{

	public function __construct(){
		$this->middleware('studentprofile');
	}


    public function show($slug)
    {
        $student = Student::whereSlug($slug)->first();
        if($student){
            $deficiencies = $student->deficiencies()->simplePaginate(5);
            return view('student.show', compact(['student', 'deficiencies']));
        }

        //Only evaluates the first numeric part (student number)
        //everything that comes after the student number is ignored
        //redirect to the proper slug with
        //20XXXXXXX-first-last format
        //HTTP 404 error if no student is found
        $student_number = intval($slug);
        $student = Student::whereStudentNumber($student_number)->firstOrFail();
        return redirect()->action('StudentController@show', ['slug' => $student->slug]);
        
    }
}
