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

    	// $student = Student::where('matric_no', $request->matricNumber)->where('key', $request->password)->first();
    	// if($student->voted == true){
    	// 	return redirect()->back()->withErrors(['alreadyVoted'=>'Candidate has voted already!']);
    	// }

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
    	$loggedStudent = Auth::guard('students')->user();

    	return view('vote-view', [
    		'student'=>$loggedStudent
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
    	$candidates = Candidate::where('position', 'Social Director')->get();

    	dd($candidates);

    	foreach ($candidates as $candidate) {
    		$votes = Vote::candidate('social_director', $candidate->id);
    		$votes = count($votes);
    		echo "{$candidate->first_name} {$candidate->last_name} had {$votes} votes <hr/>";
    	}
    }

    public function postVotes(Request $request){
		Vote::create([
			'student_id'=> $request->student_id,
			'president'=> $request->president,
			'vice_president'=> $request->vice_president,
			'pro'=> $request->pro,
			'chaplain'=> $request->chaplain,
			'social_director'=> $request->social_director,
			'sports_director'=> $request->sports_director 
		]);

		Auth::guard('students')->logout();

		return response()->json('Thank you for voting!');
    }

    public function logout(){
    	Auth::guard('students')->logout();
    	return redirect('/student-login');
    }
}
