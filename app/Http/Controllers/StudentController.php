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
        $emojis = [ '🏄🏾', '🚣‍♀️'];
    	return view('student-login', [
            'emojis'=>$emojis
        ]);
    }

    public function login(Request $request){

        //Temporary Code for admin (for testing purposes)
        if($request->matricNumber=='14/1290' && $request->password == 'hey'){
            $password = Student::where('matric_no', '14/1290')->first()->key;
            Auth::guard('students')->attempt(['matric_no'=>'14/1290', 'password'=>$password]);
            return redirect('/vote');
        }


    	$rules = ['matricNumber' => 'required|max:7', 'password'=>'required'];
        $messages = [
            'matricNumber.required' => "Please enter a matric number!",
            'password.required'=> 'Please enter a password!'
        ];
    	$this->validate($request, $rules, $messages);

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
    		return redirect()->back()->withInput($request->except('password'))->withErrors(['invalid'=>'Invalid Matric Number or password']);
    	}
    }

    public function voteView(){
        $emojis = [ '🔥', '🎉', '⚡️', '🦄', '👋🏿', '🤙🏿', '🏄🏾', '👻', ' 💩', '🌈', '🦅 ', '🌋', '🍩', '🚣‍♀️', '🚀', '🏇', '👾', '👽', ];
        
    	$loggedStudent = Auth::guard('students')->user();
        $name = explode(' ', $loggedStudent->name);
        $firstName = title_case(end($name));

        if(strlen($firstName) < 3){
            $firstName = $name[0];
        }

        $emoji = $emojis[array_rand($emojis)];

    	return view('vote-view', [
    		'student'=>$loggedStudent,
            'firstName'=>$firstName,
            'emojis'=>$emojis
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

    public function getCandidatesAPI(){
        $positions = ["PRO", "President", "Vice President", "Chaplain", "Sports Director", "Social Director"];
        $candidates = array();
        foreach($positions as $position){
            $candidates[$position] = Candidate::position($position)->get();
        }

        $studentHall = Auth::guard('students')->user()->hall;

        $senators = Candidate::position('Hall Senator')->hall($studentHall)->get();

        $senatorFloors = [];
        $senatorData = [];


        if(count($senators) > 0){
            foreach ($senators as $senator) {
                $senatorFloors[] = $senator->floor;
            }
        }
        $senatorFloors = array_unique($senatorFloors);

        foreach ($senatorFloors as $floor) {
            $senatorData[$floor] = Candidate::position('Hall Senator')->hall($studentHall)->floor($floor)->get();
        }


        return response()->json([$candidates, $senatorData]);

    }
}
