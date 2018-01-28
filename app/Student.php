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
    	return $query->where('course', $course);
    }

    public function scopeLevel($query, $level){
    	return $query->where('level', $level);
    }
}
