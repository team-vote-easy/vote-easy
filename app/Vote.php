<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Candidate;

class Vote extends Model
{
    protected $guarded = [];

    public function candidate(){
    	return $this->belongsTo(Candidate::class, 'candidate_id', 'id');
    }
}
