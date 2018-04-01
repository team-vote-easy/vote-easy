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


    	$rules = ['matricNumber' => 'required', 'password'=>'required'];
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
        $title = 'Vote';

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

    public function postVotes(Request $request){
        $loggedStudent = Student::where('id', Auth::guard('students')->user()->id)->first();
        $loggedStudent->voted = true;
        $loggedStudent->save();

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

    public function getCandidates(){
        $positions = ["PRO", "President", "Vice President", "Chaplain", "Director of Sports", "Director of Social", "General Secretary", "Director of Transport", "Treasurer", "Director of Finance", "Director of Welfare", "Senate President", "Sargent At Arms", "Assistant Gen Secretary", "Senator Chief Whip", "Deputy Senate President", "Senate Scribe"];
        $candidates = array();
        foreach($positions as $position){
            $candidates[$position] = Candidate::position($position)->get();
        }

        $studentHall = Auth::guard('students')->user()->hall;
        $studentBlock = Auth::guard('students')->user()->block;

        $senators = Candidate::position('Hall Senator')->hall($studentHall)->block($studentBlock)->get();

        $senatorFloors = [];
        $senatorData = [];
        $senatorBlocks = [];


        if(count($senators) > 0){
            foreach ($senators as $senator) {
                $senatorBlocks[] = $senator->block;
            }
            $senatorBlocks = array_unique($senatorBlocks);
            foreach ($senatorBlocks as $block) {
                $senatorData[$block] = Candidate::position('Hall Senator')->hall($studentHall)->block($block)->get();
            }            
        }




        return response()->json([$candidates, $senatorData]);

    }

    public function serializeTest(){
        $results = [];
        $positions = ["PRO", "President", "Vice President", "Chaplain", "Director of Sports", "Director of Social", "General Secretary", "Director of Transport", "Treasurer", "Director of Finance", "Director of Welfare", "Senate President", "Sargent At Arms", "Assistant Gen Secretary", "Senator Chief Whip", "Deputy Senate President", "Senate Scribe", "Hall Senator"];
        foreach($positions as $position){
            $candidates = Candidate::position($position)->get();
            foreach ($candidates as $candidate) {
                $results[$position][$candidate->first_name. ' '.$candidate->last_name]['id'] = $candidate->id;
                $results[$position][$candidate->first_name. ' '.$candidate->last_name]['votes'] = $candidate->votes == null ? 0 : $candidate->votes->count;
            }
        }

        $testString = serialize($results);

        $path = public_path().'/vote-results/result.txt';
        $file = file_put_contents($path, $testString);
        if($file){
            echo 'It worked!';
        } else{
            echo 'Nope!';
        }
    }

    public function unserializeTest(){
        try {
            $rawFile = file_get_contents(public_path().'/vote-results/result.txt');
        } 
        catch(ErrorException $e){
            echo "It did not work!";
        }
        $data = unserialize($rawFile);
        dd($data);

    }
}
