<?php

namespace App\Http\Controllers;

use App\Deficiency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class DeficiencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('studentprofile');
    }


    //Triggered when authorized user clicks "complete" button
    public function complete($id)
    {
        $def = Deficiency::findOrFail($id);
	
        //Flash notification confirming user's action
		$flash_message = 
			"Deficiency <strong>" 
			. $def->title . "</strong> marked as completed.";

		$def->checkDepartmentAndFlashMessage($flash_message);

        $def->completed = true;
        $def->save();

        //Log action
        activity()
            ->performedOn($def)
            ->causedBy(Auth::user())
            ->withProperties(['completed' => $def->completed])
            ->log('Marked deficiency as compelted.');

        //Redirect
        $previous = URL::previous() . "#def";
        return redirect()->away($previous);
    }


	public function update($id)
	{
		$def = Deficiency::findOrFail($id);

        //Flash notification confirming user's action
		$flash_message = "Item edited";

		$def->checkDepartmentAndFlashMessage($flash_message);

        $def->completed = true;
        $def->save();
	}


    public function store()
    {
        $staff = Staff::where('user_id', '=', Auth::user()->id)->firstOrFail();

        $validated_request = request()->validate([
            'title' => 'required',
            'note' => 'required',
            'student_id' => 'required|digits:9'
        ]);
        $validated_request['staff_id'] = $staff->id;
        $validated_request['department_id'] = $department_id;
        $def = Deficiency::create($validated_request);

        activity()
            ->performedOn($def)
            ->causedBy(Auth::user())
            ->withProperties(['title' => $def->title])
            ->log('Filed deficiency');

        return redirect('some.path');
	}

	
}
