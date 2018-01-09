<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $guarded = [];

    public function scopeCourse($query, $course){
    	return $query->where('course', $course);
    }

    public function scopeLevel($query, $level){
    	return $query->where('level', $level);
    }
}
