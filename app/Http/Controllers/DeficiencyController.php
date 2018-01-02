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
		//Display confirmation dialog
		//
		//If confirmed, delete item from database
		Deficiency::destroy($id);	
		//Log action
		//
		//Redirect
		$previous = URL::previous() . "#def";
		return redirect()->away($previous);
	}
}
