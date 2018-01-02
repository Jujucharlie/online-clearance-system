<?php

namespace App\Http\Controllers;

use App\Deficiency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class DeficiencyController extends Controller
{

	//Triggered when authorized user clicks "delete" button
	public function destroy($id)
	{
		$def = Deficiency::findOrFail($id);
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
