<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use Notifiable;

	protected $guard = 'students';
    protected $guarded = [];

    public function scopeCourse($query, $course){
        if($course==null) {return;}

    	return $query->where('course', $course);
    }

    public function scopeLevel($query, $level){
        if($level==null) {return;}
    	return $query->where('level', $level);
    }

    public function scopeHall($query, $hall){
        if($hall==null) {return;}
    	return $query->where('hall', $hall);
    }
}
