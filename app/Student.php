<?php

namespace App;

use App\AbstractUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class Student extends AbstractUser
{
    public function program()
    {
        return $this->belongsTo('App\Program');
    }

    public function department()
    {
        return $this->program->department;
    }

    public function college()
    {
        return $this->department()->college;
    }

    /**
     * Formatted student number
     * @return  student number in yyyy-xxxxx
     */
    public function student_number()
    {
        $year = floor($this->student_number / 100000);
        $num = $this->student_number % 100000;

        return $year . '-' . str_pad($num, 5, '0', STR_PAD_LEFT);
    }

    public function deficiencies()
    {
        return $this->hasMany('App\Deficiency');
    }

	public function completedDeficiencies()
	{
		return $this->deficiencies->where('completed', true);
	}

	/* Aliasing the method above */		
	public function completeDeficiencies()
	{
		return $this->deficiencies->where('completed', true);
	}

	public function incompleteDeficiencies()
	{
		
		return $this->deficiencies->where('completed', false);
	}
	
	public function deficienciesForShow($sort, $order, $items_per_page)
	{
		$deficiencies = DB::table('deficiencies')
			->where('student_id', '=', $this->id)
			->where('completed', '=', false)
			->join('departments',
					'departments.id', '=', 'deficiencies.department_id')
			->join('staff', 'staff.id', '=', 'deficiencies.staff_id')
			->select('slug as staff_slug',
					'name as dept_name',
					'short_name as dept_short_name', 'deficiencies.*')
			->orderBy($sort, $order)
			->orderBy('title', $order)
			->simplePaginate($items_per_page);

		return $deficiencies;
		
	}
	
	

    /**
     * URI to studet's ID photo
     */
    public function picture()
    {
		$file = public_path() . '/images/id/' . $this->slug . '.jpg';
		if(file_exists($file)){
			return '/images/id/' . $this->slug . '.jpg';
		}
        return asset('images/id/default.png');
    }


    public function getSlugSourceAttribute()
    {
        return $this->student_number . ' ' . $this->name();
    }

    public function linkTo()
    {
        return "/student/" . $this->slug;
    }
}
