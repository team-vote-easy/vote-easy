<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;

use App\Candidate;

use App\Vote;

use App\Post;

use Auth;

class VoteController extends Controller
{
	public $positions = ["PRO", "President", "Vice President", "Chaplain", "Director of Sports", "Director of Social", "General Secretary", "Director of Transport", "Treasurer", "Director of Finance", "Director of Welfare", "Senate President", "Sargent At Arms", "Assistant Gen Secretary", "Senator Chief Whip", "Deputy Senate President", "Senate Scribe"];

	public function getVotesView(){
		$admin = Auth::guard('admin')->user()->name;
		$result = $this->getVotes();
		return view('view-votes', [
			'admin'=>$admin,
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

	public function senatorVotesView(){
		$admin = Auth::guard('admin')->user()->name;
		$halls = ["Samuel Akande", "Queen Esther", "Nelson Mandela", "Bethel Splendor", "Kings Delight Hall", "Winslow", "Gideon Troopers", "Welch", "Crystal", "Platinum", "Marigold", "FAD", "Queen Esther", "Off-Campus"];
        $blocks = ["First Floor", "Second Floor", "Third Floor", "A", "B", "C", "D", "E", "F", "G", "H"];
        return view('view-senator-votes', [
        	'halls'=>$halls,
        	'blocks'=>$blocks,
        	'admin'=>$admin
        ]);
	}

	public function getSenatorVotes(Request $request){
		$count = 0;
		$candidateSet = array();
		$candidates = Candidate::position('Hall Senator')->hall($request->hall)->block($request->block)->get();
		foreach ($candidates as $candidate) {
			if($candidate->votes == ''){
				$votes = 0;
			} else{
				$votes = $candidate->votes->count;
			}
			$candidateSet[$count]['candidate'] = $candidate;
			$candidateSet[$count]['votes'] = $votes;
			$count++;
		}
		return response()->json($candidateSet);
	}
}
