<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;

use App\Candidate;

use Auth;

class FetchController extends Controller
{
    public function fetchCourseView(){
        $admin = Auth::guard('admin')->user()->name;
        $courses = ["Computer Science", "Computer Technology", "Computer Information Systems", "All"];
        $levels = [100, 200, 300, 400, 'All'];
        $halls = ["Samuel Akande", "Queen Esther", "Nelson Mandela", "Bethel Splendor", "Kings Delight Hall", "Winslow", "Gideon Troopers", "Welch", "Crystal", "Platinum", "Marigold", "FAD", "Queen Esther", "Off-Campus", "All"];
        return view('fetch-view-course', [
            'admin'=>$admin,
            'courses'=>$courses,
            'levels'=>$levels,
            'halls'=>$halls
        ]);
    }

    public function fetchCourse(Request $request){

        if($request->course=='All' || $request->course==''){
            $course = null;
        } else{
            $course = $request->course;
        }

        if($request->level=='All' || $request->level==''){
            $level = null;
        } else{
            $level = $request->level;
        }

        if($request->hall=='All' || $request->hall==''){
            $hall=null;
        } else{
            $hall = $request->hall;
        }

        $students = Student::course($course)->level($level)->hall($hall)->get();
        $count = count($students);
        $course = $course == '' ? 'All courses' : $course;
        $level = $level == '' ? 'All Levels' : "$level level";
        $hall = $hall == '' ? 'All Halls' : "$hall hall";

        $response = [
            'message' => "There are $count students from $hall in $level studying $course",
            'students'=>$students
        ];
        return response()->json($response);
    }

    public function fetchStudentView(){
        $admin = Auth::guard('admin')->user()->name;
        return view('fetch-view-student',[
            'admin'=>$admin
        ]);
    }

    public function fetchStudent(Request $request){
    	$student = Student::where('matric_no', $request->matricNumber)->first();
    	return response()->json($student);
    }

    /* Fetch Candidate */

    public function fetchCandidateView(){
        $admin = Auth::guard('admin')->user()->name;
        return view('fetch-candidates', [
            'admin'=>$admin
        ]);
    }

    public function fetchCandidate(Request $request){
        if($request->position == '' || $request->position=='All'){
            $position = null;
        }
        else{
            $position= $request->position;
        }

        if($request->course == '' || $request->course=='All'){
            $course = null;
        }
        else{
            $course = $request->course;
        }

        if($request->level == '' || $request->level=='All'){
            $level = null;
        }
        else{
           $level=$request->level;
        }

        return response()->json(Candidate::position($position)->course($course)->level($level)->get());
    }

}
