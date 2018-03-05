<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
   protected $guarded = [];

   public function scopePosition($query, $position){
    if($position==null){
      return;
    }
   	return $query->where('position', $position);
   }

   public function scopeCourse($query, $course){
      if($course==null){
        return;
      }
    	return $query->where('course', $course);
    }

    public function scopeLevel($query, $level){
      if($level==null){
        return;
      }
    	return $query->where('level', $level);
    }

    public function votes(){
      return $this->hasOne(Vote::class, 'candidate_id', 'id');
    }
}
