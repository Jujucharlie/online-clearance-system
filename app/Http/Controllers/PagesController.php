<?php

namespace App\Http\Controllers;


use App\College;
use App\Department;
use App\Program;
use App\Staff;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
	public function index()
	{
	   
        $colleges = College::all();
        $counts = [
                'department' => Department::all()->count(),
                'staff' => Staff::all()->count(),
                'program' => Program::all()->count(),
                'student' => Student::all()->count()
                ];

		return view('pages.index', compact('colleges', 'counts'));
	}

    public function program($short_name)
    {

    	$program = Program::where('short_name', $short_name)->first();

    	return view('program.show', compact('program'));
    }

    public function department($short_name)
    {

    	$department = Department::where('short_name', $short_name)->first();

    	return view('department.show', compact('department'));
    }

    public function profile()
    {
        $user = Auth::user();
        $student = Student::whereUserId($user->id)->firstOrFail();
        
        return redirect()->action('StudentController@show', ['slug' => $student->slug]);
    }

    public function user()
    {
        return view('pages.user');
    }
}
