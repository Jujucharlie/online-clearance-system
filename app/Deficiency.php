<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deficiency extends Model
{
    public function student()
    {
    	return $this->belongsTo('App\Student');
    }

    public function staff()
    {
    	return $this->belongsTo('App\Staff');
    }

    public function posted_by()
    {
        return $this->staff->name();
    }

    public function department()
    {
    	return $this->belongsTo('App\Department');
    }

    /*
        Returns the post date of a deficiency,
        converted to a device's local timezone
        and formatted to a readable format
     */
    public function postDate()
    {
        return $this->created_at->toFormattedDateString();
    }

    public function postDateTime()
    {
        return $this->created_at->toDayDateTimeString();
    }
}
