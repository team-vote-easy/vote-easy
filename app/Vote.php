<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Candidate;

class Vote extends Model
{
    protected $guarded = [];

    public function scopeCandidate($query, $position, $candidateID){
    	return $query->where($position, $candidateID);
    }

    // public function scopeCandidate($query, $position){
    // 	$candidate = 
    // }
}
