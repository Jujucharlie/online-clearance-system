<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('studentprofile');
    }

    public function show($slug, Request $request)
    {
        $items_per_page = 5;
        $student = Student::whereSlug($slug)->first();

        if ($student) {
            //column sort
            if ($request->has('sort')) {
                switch ($request->input('sort')) {
                case "department":
                    $sort = "dept_short_name";
                    break;
                case "staff":
                    $sort = "staff_slug";
                    break;
                case "date":
                    $sort = "created_at";
                    break;
                case "title":
                    $sort = "title";
                    break;
                case "date":
                default:
                $sort = "created_at";
                }
            } else {
                $sort = "created_at";
            }

            if ($request->has('order')) {
                switch ($request->input('order')) {
                case "asc":
                    $order = "asc";
                    break;
                case "desc":
                default:
                $order = "desc";
                }
            } else {
                $order = "desc";
            }

            // $deficiencies = $student->deficiencies()->orderBy($sort, $order)->simplePaginate(5);

            $deficiencies = DB::table('deficiencies')
                ->where('student_id', '=', $student->id)
                ->where('completed', '=', false)
                ->join('departments', 'departments.id', '=', 'deficiencies.department_id')
                ->join('staff', 'staff.id', '=', 'deficiencies.staff_id')
                ->select('slug as staff_slug', 'name as dept_name', 'short_name as dept_short_name', 'deficiencies.*')
                ->orderBy($sort, $order)
                ->orderBy('title', $order)
                ->simplePaginate($items_per_page);

            $sort = $request->input('sort');
            $order = $request->input('order');

            return view('student.show', compact(['student', 'deficiencies', 'sort', 'order']));
        }//end if($student)

        // Only evaluates the first numeric part (student number)
        // everything that comes after the student number is ignored
        // redirect to the proper slug with
        // 20XXXXXXX-first-last format
        // HTTP 404 error if no student is found
        $student_number = intval($slug);
        $student = Student::whereStudentNumber($student_number)->firstOrFail();
        return redirect()->action('StudentController@show', ['slug' => $student->slug]);
    }
}
