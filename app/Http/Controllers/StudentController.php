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

            //column sort
            if(isset($_GET['sort'])){
                switch($_GET['sort']){
                    case "department": 
                        $sort = "department_id";
                        break;
                    case "staff":
                        $sort = "staff_id";
                        break;
                    case "date":
                        $sort = "created_at";
                        break;
                    case "title":
                        $sort = "title";
                        break;
                    default:
                        $sort = "created_at";
                }
            }else{
                $sort = "created_at";
            }

            //sort order
            if(isset($_GET['order'])){
                $order = $_GET['order'] == "asc" ? "asc" : "desc";
            }else{
                $order = "desc";
            } 

            $deficiencies = $student->deficiencies()->orderBy($sort, $order)->simplePaginate(5);
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
