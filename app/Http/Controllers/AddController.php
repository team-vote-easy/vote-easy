<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Candidate;
class AddController extends Controller
{
    public function showAdd(){
    	$courses = ["Computer Science", "Computer Technology", "Computer Information Systems"];
		$levels = [100, 200, 300, 400];
		$positions = ["PRO", "President", "Vice President", "Chaplain", "Sports Director", "Social Director"];
		return view('add-candidates', [
			'courses'=>$courses,
			'levels'=>$levels,
			'positions'=>$positions
		]);
    }

    public function add(Request $request){
    	$candidate = Candidate::create([
    		'first_name'=>$request->firstName,
    		'last_name'=>$request->lastName,
    		'level'=>$request->level,
    		'course'=>$request->course,
    		'position'=>$request->course,
    		'image'=>''
    	]);

    	return response()->json($candidate, 200);
    }
}
