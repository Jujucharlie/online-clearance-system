<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskItem extends Model
{
	public function task_group()
	{
		return $this->belongsTo('App\TaskGroup');
	}

	public function department()
	{
		return $this->task_group->department;
	}
	
	
}
