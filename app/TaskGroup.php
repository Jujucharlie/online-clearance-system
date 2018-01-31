<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskGroup extends Model
{
	public function task_items()
	{
		return $this->hasMany('App\TaskItem');
	}

	public function department()
	{
		return $this->belongsTo('App\Department');
	}
	
	
}
