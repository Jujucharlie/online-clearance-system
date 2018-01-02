<?php

namespace App\Http\Controllers;

use App\Deficiency;
use App\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class DeficiencyController extends Controller
{

	//Triggered when authorized user clicks "delete" button
	public function destroy($id)
	{
		$user = Auth::user();

		if(!$user){
			abort(403);
		}

		$staff = Staff::whereUserId($user->id)->firstOrFail();

		$def = Deficiency::findOrFail($id);

		if($staff->department != $def->department){
			$flash_message = "Sorry, you are not allowed to do that.";
			flash($flash_message)->error()->important();

			return redirect()->back();
		}
		//Display confirmation dialog (modal, maybe?)
		

		$flash_message = "Deficiency <strong>" . $def->title . "</strong> marked as completed.";
		flash($flash_message)->success();

		$def->completed = true;
		$def->save();
		//If confirmed, delete item from database
		//Log action
		//
		//Redirect
		$previous = URL::previous() . "#def";
		return redirect()->away($previous);
	}
}
