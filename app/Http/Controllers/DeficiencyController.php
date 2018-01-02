<?php

namespace App\Http\Controllers;

use App\Deficiency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class DeficiencyController extends Controller
{

	public function __construct(){
		$this->middleware('studentprofile');
	}


	//Triggered when authorized user clicks "complete" button
	public function update($id)
	{

		$def = Deficiency::findOrFail($id);

		if(!$def->userInSameDepartment()){
			$flash_message = "Sorry. You do not have permission to perform that action.";
			flash($flash_message)->error()->important();

			return redirect()->back();
		}
		
		//Flash notification confirming user's action
		$flash_message = "Deficiency <strong>" . $def->title . "</strong> marked as completed.";
		flash($flash_message)->success();

		$def->completed = true;
		$def->save();

		//Log action
		activity()
		->performedOn($def)
		->causedBy(Auth::user())
		->withProperties(['completed' => true])
		->log('Marked deficiency as compelted.');

		//Redirect
		$previous = URL::previous() . "#def";
		return redirect()->away($previous);
	}

}
