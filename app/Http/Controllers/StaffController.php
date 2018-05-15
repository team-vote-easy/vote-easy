<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Staff;

use Auth;

use Hash;

use App\Log;

use App\Student;

use App\Vote;

use GuzzleHttp\Client;

use Carbon\Carbon;
date_default_timezone_set("Africa/Lagos");

class StaffController extends Controller
{
	public function addStaffView(){
		$admin = Auth::guard('admin')->user()->name;
		$halls = ["Samuel Akande", "Queen Esther", "Nelson Mandela", "Bethel Splendor", "Neal Wilson", "Nyberg", "Ogden", "Winslow", "Gideon Troopers", "Welch", "Crystal", "Platinum", "Felicia Adebisi Dada (FAD)", "Queen Esther", "Off-Campus", "Ameyo Adadevoh", "Gamaliel", "Havilah Gold", "Justice Deborah", "White"];
		sort($halls);

		return view('add-staff', [
			'admin'=>$admin,
			'halls'=>$halls

		]);
	} 

	public function addStaff(Request $request){
		$existingStaff = Staff::where('hall', $request->hall)->first();
		if($existingStaff){
			return response()->json("Sorry a staff for $request->hall already exists!", 500);
		}

		$randomString = str_random(5);
		$key = str_replace(' ', '-', strtolower($request->hall));
		$key = "$key-$randomString";
		$staff = Staff::create([
			'first_name'=>$request->firstName,
			'last_name'=>$request->lastName,
			'username'=>$request->username,
			'phone'=>$request->phone,
			'hall'=>$request->hall,
			'key'=>$key,
			'password'=>Hash::make($key)
		]);

		if($staff){
			return response()->json($staff, 200);
		} else{
			return response()->json("Sorry couldnt create the staff!", 500);
		}
	}

	public function viewStaffView(){
		$admin = Auth::guard('admin')->user()->name;
		return view('fetch-staff', ['admin'=>$admin]);
	}

	public function viewStaff(){
		$staff = Staff::all();
		return response()->json($staff, 200);
	}

	  public function staffLoginView(){
			return view('staff-login');
	  }

	  public function login(Request $request){
		$rules = [
			'username'=> 'required', 
			'password'=>'required'
		];

	 	$messages = [
			'username.required' => "Please enter a username!",
			'password.required'=> 'Please enter a password!'
		];

		$this->validate($request, $rules, $messages);

		if(Auth::guard('staff')->attempt(['username'=>$request->username, 'password'=>$request->password])){
			return redirect('/staff/home');
		}
		else{
			return redirect()->back()->withInput($request->except('password'))->withErrors(['invalid'=>'Invalid username or password']);
		}
	}

	public function logout(){
		Auth::guard('staff')->logout();
		return redirect('/staff/login');
	}

	public function staffHome(){
		$hall = Auth::guard('staff')->user()->hall;
		$staff = Auth::guard('staff')->user()->username;
		return view('staff-home', [
			'staff'=>$staff, 'hall'=>$hall
		]);
	}

	public function fetchStudent(Request $request){
    	$student = Student::where('matric_no', $request->matricNumber)->first();
    	return response()->json($student);
    }

    public function breakDownView(){
    	$staff = Auth::guard('staff')->user()->username;
    	$hall = Auth::guard('staff')->user()->hall;
    	$totalStudents = Student::hall($hall)->count();
    	$votedStudents = Student::hall($hall)->where('voted', true)->count();
    	$unvotedStudents = Student::hall($hall)->where('voted', false)->count();
   	


    	return view('staff-view-breakdown',[
    		'totalStudents'=>$totalStudents, 'votedStudents'=>$votedStudents, 'staff'=>$staff, 'unvotedStudents'=>$unvotedStudents, 'hall'=>$hall
    	]);
    }

    public function pushToServerView(){
    	$staff = Auth::guard('staff')->user()->username;
    	$hall = Auth::guard('staff')->user()->hall;
    	$lastLog = Log::orderBy('id', 'desc')->first();
    	return view('staff-push-to-server', ['lastLog'=>$lastLog, 'staff'=>$staff, 'hall'=>$hall]);
    }

    public function pushToServer(){   	
    	$client = new Client();
    	$votes = Vote::all();
    	$hall = Auth::guard('staff')->user()->hall;
    	$staff = Auth::guard('staff')->user()->id;
    	$response = $client->request('POST', 'http://busa-admin.test/api/push-votes', [
 			'json'=>[
 				'hall'=>$hall,
 				'staff'=>$staff,
 				'votes'=>$votes
 			]
    	]);

    	$existingLog = Log::where('staff_id', $staff)->first();
    	if($existingLog){
    		$existingLog->push_time = date("h:i:sa");
    		$existingLog->save();
    	} else{
	    	Log::create([
	    		"push_time"=> date("h:i:sa"),
	    		"staff_id"=>$staff
	    	]);
    	}

    	return $response->getBody()->getContents();
    }

    public function getStaffLog(){
    	$staff = Auth::guard('staff')->user()->id;
    	$time = Log::where('staff_id', $staff)->first();

    	if($time){
    		return response()->json($time->push_time, 200);
    	} else{
    		return response()->json('', 200);
    	}
    }


}
