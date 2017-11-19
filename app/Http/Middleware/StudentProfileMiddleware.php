<?php

namespace App\Http\Middleware;

use App\Student;
use Closure;
use Illuminate\Support\Facades\Auth;

class StudentProfileMiddleware
{
    /**
     * The following are allowed to view a student profile:
     * admin
     * staff
     * a student can only view their own profile
     */
    public function handle($request, Closure $next)
    {

        if(Auth::guest()){
            abort(403);
        }

        else{
            $user = $request->user();

            if($user->hasRole('staff') || $user->hasRole('admin')){
                return $next($request);
            }

            if($user->hasRole('student')){

                $student = Student::whereUserId($user->id)->first();
                if($student->student_number == $request->student){
                    return $next($request);
                }
                abort(403);
            }
            
        }
        // return $next($request);
    }
}
