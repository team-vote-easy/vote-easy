<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;

use App\Candidate;

use Auth;

use Hash;

class StudentController extends Controller
{
    public function loginView(){
    	return view('student-login');
    }

    public function login(Request $request){

    	// Student::create([
    	// 	'first_name'=>'Chukwudi',
    	// 	'last_name'=>'Oranu',
    	// 	'matric_no'=>'14/1290',
    	// 	'course'=>'Computer Technology',
    	// 	'level'=>400,
    	// 	'password'=>Hash::make('hey')
    	// ]);
    	
    	$rules = ['matricNumber' => 'required|max:7', 'password'=>'required'];
    	$this->validate($request, $rules);

    	if(Auth::guard('students')->attempt(['matric_no'=>$request->matricNumber, 'password'=>$request->password])){
    		return redirect('/vote');
    	}
    	else{
    		return redirect()->back()->withInput($request->except('password'));
    	}
    }

    public function voteView(){
    	return view('vote-view');
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
}
