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

	public function phpTest(){
		$this->CountWords('chukwudioranu@ymail.com');
		$this->doStuff();
	}

	public function CountWords($str){
	   echo "<table border='1'> <tr> <th colspan='4'> Powers Table </th> <tr><th>Numbers</th> <th>Square Root</th> <th>Square</th> <th>Cube </th>";
	   for($i=1; $i<=5; $i++){
	   		$squareRoot = sqrt($i);
	   		$square = pow($i, 2);
	   		$cube = pow($i, 3);
	   		echo "<tr><td>$i</td> <td>$squareRoot</td> <td>$square</td> <td>$cube</td> </tr>";
	   }
	   echo "</table>";
	}

	public function doStuff(){
		dd($_SERVER);
	}
}
