<?php

namespace App\Http\Controllers;

use App\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function show($slug)
    {
        if (is_numeric($slug)) {
            $staff = Staff::find($slug)->firstOrFail();
            return redirect()->action('StaffController@show', ['slug' => $staff->slug]);
        }

        $staff = Staff::whereSlug($slug)->firstOrFail();
        return view('staff.show', compact('staff'));
    }
}
