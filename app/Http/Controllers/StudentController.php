<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;

use App\Candidate;

use App\Vote;

use Auth;

use Hash;

class StudentController extends Controller
{
    public function loginView(){
    	return view('student-login');
    }

    public function login(Request $request){
    	$rules = ['matricNumber' => 'required|max:7', 'password'=>'required'];
    	$this->validate($request, $rules);

    	$student = Student::where('matric_no', $request->matricNumber)->where('key', $request->password)->first();

        if($student){
            if($student->voted == true){
                return redirect()->back()->withErrors(['alreadyVoted'=>'Candidate has voted already!']);
            }
        }

    	if(Auth::guard('students')->attempt(['matric_no'=>$request->matricNumber, 'password'=>$request->password])){
    		$loggedStudent = Student::where('id', Auth::guard('students')->user()->id)->first();
    		$loggedStudent->voted = true;
    		$loggedStudent->save();
    		return redirect('/vote');
    	}
    	else{
    		return redirect()->back()->withInput($request->except('password'));
    	}
    }

    public function voteView(){
         $emojis = [ '🔥', '🎉', '⚡️', '🦄', '👋🏿', '🤙🏿', '🏄🏾', '👻', ' 💩', '🌈', '🕊 ', '🦅 '];
        
    	$loggedStudent = Auth::guard('students')->user();
        $firstName = explode(' ', $loggedStudent->name);
        $firstName = title_case(end($firstName));

        $emoji = $emojis[array_rand($emojis)];

    	return view('vote-view', [
    		'student'=>$loggedStudent,
            'firstName'=>$firstName,
            'emoji'=>$emoji
    	]);
    }



    public function getStudent(){
    	$loggedStudent = Auth::guard('students')->user();
    	return response()->json($loggedStudent);
    }


    public function getCandidates(Candidate $candidates){
    	$responseData = array();

    	$responseData['president'] = $candidates->where('position', 'President')->get();
    	$responseData['vicePresident'] = $candidates->where('position', 'Vice President')->get();
    	$responseData['pro'] = $candidates->where('position', 'PRO')->get();	
    	$responseData['socialDirector'] = $candidates->where('position', 'Social Director')->get();
    	$responseData['chaplain'] = $candidates->where('position', 'Chaplain')->get();
    	$responseData['sportsDirector'] = $candidates->where('position', 'Sports Director')->get();
    	

    	return response()->json($responseData);
    }

    public function test(){
    	$candidates = Candidate::where('position', 'president')->get();

    	foreach ($candidates as $candidate) {
    		$votes = Vote::candidate('president', $candidate->id)->count();
    		echo "{$candidate->first_name} {$candidate->last_name} had {$votes} votes <hr/>";
    	}
    }

    public function postVotes(Request $request){
        $candidates = $request->all();

        foreach($candidates as $candidate){
            $vote = Vote::where('candidate_id', $candidate)->first();
            if($vote){
                $vote->increment('count', 1);
            }
            else{
                Vote::create(['candidate_id'=>$candidate, 'count'=>1]);
            }
        }

		Auth::guard('students')->logout();

		return response()->json('Thank you for voting!');
    }

    public function logout(){
    	Auth::guard('students')->logout();
    	return redirect('/student-login');
    }
}
