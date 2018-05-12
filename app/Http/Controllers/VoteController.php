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
	public $positions = ["President", "Vice President (Main)", "Vice President (Iperu)", "General Secretary", "Assistant General Secretary", "Treasurer", "Director of Financial Records", "Director of Public Relations (Main)", "Director of Public Relations (Iperu)", "Director of Socials (Main)", "Director of Socials (Iperu)", "Director of Sports (Main)", "Director of Sports (Iperu)", "Director of Transport and Ventures (Main)", "Director of Transport and Ventures (Iperu)", "Director of Welfare (Main)", "Director of Welfare (Iperu)", "Sergeant At Arms", "Chaplain"];

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
		$halls = ["Samuel Akande", "Queen Esther", "Nelson Mandela", "Bethel Splendor", "Neal Wilson", "Nyberg", "Ogden", "Winslow", "Gideon Troopers", "Welch", "Crystal", "Platinum", "Felicia Adebisi Dada (FAD)", "Queen Esther", "Off-Campus", "Ameyo Adadevoh", "Gamaliel", "Havilah Gold", "Justice Deborah"];
        $blocks = ["GF", "FF", "TF", "SF", "A", "B", "C", "D", "E", "F", "G", "H", "100", "200", "300", "400"];
        sort($halls);
        sort($blocks);
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
