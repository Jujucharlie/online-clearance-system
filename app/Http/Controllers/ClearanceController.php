<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Student;

class ClearanceController extends Controller
{
	public function requestClearance()
	{
		$student = Student::where('user_id', Auth::user()->id)->firstOrFail();

		$purpose = request()->get('purpose');

		switch($purpose){
			case 'loa': 
				$purpose_str = 'Leave of Absence: from '
					. $this->semesterText(request()->get('from-sem')) 
					. ' to ' . $this->semesterText(request()->get('to-sem'));
			break;

			case 'grad': 
				$purpose_str = 'Graduation: '
					. $this->semesterText(request()->get('current-sem'));
			break;

			case 'transfer': 
				$purpose_str = 'Transfer to: ' . request()->get('transfer-text');
			break;

			case 'other': 
				$purpose_str = 'Other: ' . request()->get('other-text');
			break;
		}

		$student->purpose = $purpose_str;
		$student->save();

		//log clearance request activity
        activity()
            ->performedOn($student)
            ->causedBy($student)
            ->withProperties(['purpose' => $purpose_str])
			->log("Requested college clearance");
		
		//redirect
		return redirect()->back();
	}


	public function semesterText($sem)
	{
		$start = floor($sem/10) + 1900;
		$x = $sem%10;

		switch($x){
			case 1: $y = "First Semester"; break;
			case 2: $y = "Second Semester"; break;
			case 3: $y = "Summer"; break;
		}

		return "AY " . $start . "-" . ($start+1) . " " . $y;
	}
	
	
}
