<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;

use Auth;

class AnalyticsController extends Controller
{
    public function breakDownView(){
    	$admin = Auth::guard('admin')->user()->name;

    	$totalStudents = Student::all()->count();
    	$votedStudents = Student::where('voted', true)->count();
    	$unvotedStudents = Student::where('voted', false)->count();
    	$levelsData = array();
    	$coursesData = array();
    	$levels = [100, 200, 300, 400];
    	$courses = ["Computer Science", "Computer Technology", "Computer Information Systems"];

    	foreach ($levels as $level) {
    		$levelsData[$level] = Student::level($level)->where('voted', true)->count();
    	}

    	foreach ($courses as $course) {
    		$coursesData[$course] = Student::course($course)->where('voted', true)->count();
    	}

    	return view('view-breakdown',[
    		'totalStudents'=>$totalStudents, 'votedStudents'=>$votedStudents, 'levelsData'=>$levelsData, 'coursesData'=>$coursesData, 'admin'=>$admin, 'unvotedStudents'=>$unvotedStudents
    	]);
    }
}
