<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;

class FetchController extends Controller
{
    public function showFetch(){
    	return view('fetchDetails');
    }

    public function fetchDetails(Request $request, Student $fetch){
    	$student = $fetch->where('matric_no', $request->matric_no)->first();
    	return view('showDetails', [
    		'student'=>$student

    	]);
    }

    public function fetchCourse(Request $request, $course){
    	if($course=='ct100'){
    		$ct100 = Student::course('Computer Technology')->level(100)->get();
    	}
    	if($course=='ct200'){
    		$ct200 = Student::course('Computer Technology')->level(200)->get();
    	}
    	if($course=='ct300'){
    		$ct300 = Student::course('Computer Technology')->level(300)->get();
    	}
    	if($course=='ct400'){
    		$ct400 = Student::course('Computer Technology')->level(400)->get();
    		return $ct400;
    	}



    	if($course=='cs100'){
    		$cs100 = Student::course('Computer Science')->level(100)->get();
    	}
    	if($course=='cs200'){
    		$cs200 = Student::course('Computer Science')->level(200)->get();
    	}
    	if($course=='cs300'){
    		$cs300 = Student::course('Computer Science')->level(300)->get();
    	}
    	if($course=='cs400'){
    		$cs400 = Student::course('Computer Science')->level(400)->get();
    	}



    	if($course=='cis100'){
    		$cis100 = Student::course('Computer Information Systems')->level(100)->get();
    		return $cis100;
    	}
    	if($course=='cis200'){
    		$cis200 = Student::course('Computer Information Systems')->level(200)->get();
    		return $cis200;
    	}
    	if($course=='cis300'){
    		$cis300 = Student::course('Computer Information Systems')->level(300)->get();
    		return $cis300;
    	}
    	if($course=='cis400'){
    		$cis400 = Student::course('Computer Information Systems')->level(400)->get();
    		return $cis400;
    	}
    }

    public function vue(Request $request){
        $rules = [
            'first_name'=> 'required',
            'last_name'=> 'required',
            'matric_no'=>'required|unique:students',
            'course'=> 'required',
            'level'=> 'required',
            'password'=>'required|max:5'
        ];

        $customMessages = [
            'first_name.required'=> 'We need your first name sir!',
            'last_name.required'=> 'We need your last name sir!',
            'matric_no.unique'=>'Matric number already exists'
        ];

        $this->validate($request, $rules, $customMessages);

        Student::create($request);

        return response()->json(['message'=>'Created Student!']);
    }


}
