<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;

use App\Candidate;

use App\Vote;

use App\Post;

class VoteController extends Controller
{
	public $positions = ["PRO", "President", "Vice President", "Chaplain", "Sports Director", "Social Director"];

	public function getVotesView(){
		$result = $this->getVotes();
		return view('view-votes', [
			'positions'=>$this->positions
		]);
	}

    public function getVotes(){
    	$result = array();
    	foreach($this->positions as $position){
    		$count = 0;
    		$candidates = Candidate::where('position', $position)->get();

    		$result[$position]['name'] = $position;
    		$result[$position]['candidates'] = $candidates;
    		foreach($result[$position]['candidates'] as $c){
    			if($c->votes == ''){
    				$votes = 0;
    			}
    			else{
    				$votes = $c->votes->count;
    			}
    			$result[$position]['candidates'][$count]['count'] = $votes;
    			$count++;
    		} 
    	}
    	return $result;
    }
}
