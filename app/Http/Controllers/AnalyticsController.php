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
   	


    	return view('view-breakdown',[
    		'totalStudents'=>$totalStudents, 'votedStudents'=>$votedStudents, 'admin'=>$admin, 'unvotedStudents'=>$unvotedStudents
    	]);
    }
}
