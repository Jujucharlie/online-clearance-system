<?php

namespace App;

use App\AbstractUser;
use Illuminate\Support\Facades\DB;

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
     * URL to studet's ID photo
     */
    public function picture()
    {
        // $pictures = [
        //     'wall' => 'http://a.espncdn.com/combiner/i?img=/i/headshots/nba/players/full/4237.png&w=350&h=254',
        //     'kpoz' => 'http://a.espncdn.com/combiner/i?img=/i/headshots/nba/players/full/3102531.png&w=350&h=254',
        //     'lonzo' => 'http://a.espncdn.com/combiner/i?img=/i/headshots/nba/players/full/4066421.png&w=350&h=254',
        //     'adams'=> 'http://a.espncdn.com/combiner/i?img=/i/headshots/nba/players/full/2991235.png&w=350&h=254',
        //     'curry' => 'http://a.espncdn.com/combiner/i?img=/i/headshots/nba/players/full/3975.png&w=350&h=254',
        //     'westbrook' => 'http://a.espncdn.com/combiner/i?img=/i/headshots/nba/players/full/3468.png&w=350&h=254',
        //     'harden' => 'http://a.espncdn.com/combiner/i?img=/i/headshots/nba/players/full/3992.png&w=350&h=254',
        //     'scal' => 'http://a.espncdn.com/combiner/i?img=/i/headshots/nba/players/full/1021.png&w=350&h=254',
        //     'kobe' => 'http://a.espncdn.com/combiner/i?img=/i/headshots/nba/players/full/110.png&w=350&h=254',
        //     'lebron' => 'http://a.espncdn.com/combiner/i?img=/i/headshots/nba/players/full/1966.png&w=350&h=254',
        //     'durant' => 'http://a.espncdn.com/combiner/i?img=/i/headshots/nba/players/full/3202.png&w=350&h=254',
        //     'duncan' => 'http://a.espncdn.com/combiner/i?img=/i/headshots/nba/players/full/215.png&w=350&h=254',
        //     'kyrie' => 'http://a.espncdn.com/combiner/i?img=/i/headshots/nba/players/full/6442.png&w=350&h=254',
        //     'thomas' => 'http://a.espncdn.com/combiner/i?img=/i/headshots/nba/players/full/6472.png&w=350&h=254',
        //     'pg13' => 'http://a.espncdn.com/combiner/i?img=/i/headshots/nba/players/full/4251.png&w=350&h=254',
        //     'melo' => 'http://a.espncdn.com/combiner/i?img=/i/headshots/nba/players/full/1975.png&w=350&h=254',
        //     'blake' => 'http://a.espncdn.com/combiner/i?img=/i/headshots/nba/players/full/3989.png&w=350&h=254',
        //     'drose' => 'http://a.espncdn.com/combiner/i?img=/i/headshots/nba/players/full/3456.png&w=350&h=254',
        // ];

        // $rand_key = array_rand($pictures);
        // return $pictures[$rand_key];
        return asset('images/id/melbs.jpg');
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
