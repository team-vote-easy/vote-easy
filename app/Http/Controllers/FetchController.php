<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;

use App\Candidate;

class FetchController extends Controller
{
    public function fetchCourseView(){
        $courses = ["Computer Science", "Computer Technology", "Computer Information Systems", "All"];
        $levels = [100, 200, 300, 400, 'All'];
        return view('fetch-view-course', [
            'courses'=>$courses,
            'levels'=>$levels
        ]);
    }

    public function fetchCourse(Request $request){
        if(($request->course=='All' || $request->course=='') && ($request->level=='All' || $request->level=='')){
            $students = Student::all();
            $count = count($students);
            $response = [
                'message'=> "There are {$count} students in Total",
                'students'=> $students
            ];
            return response()->json($response);
        }

        if($request->level=='All' || $request->level==''){
            $students = Student::course($request->course)->get();
            $count = count($students);
            $response = [
                'message'=> "There are {$count} {$request->course} students in Total",
                'students'=> $students
            ];
            return response()->json($response);
        }

        if($request->course=='All' || $request->course==''){
            $students = Student::level($request->level)->get();
            $count = count($students);
            $response = [
                'message'=> "There are {$count} {$request->level} Level students in total",
                'students'=>$students
            ];
            return response()->json($response);
        }

        $students = Student::course($request->course)->level($request->level)->get();
        $count = count($students);
        $response = [
            'message' => "There are [${count}] {$request->level} Level {$request->course} students in total",
            'students'=>$students
        ];
        return response()->json($response);
    }

    public function fetchStudentView(){
        return view('fetch-view-student');
    }

    public function fetchStudent(Request $request){
    	$student = Student::where('matric_no', $request->matricNumber)->first();
    	return response()->json($student);
    }

    /* Fetch Candidate */

    public function fetchCandidateView(){
        return view('fetch-candidates');
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

    public function vueTest(){
        return view('vue-test');
    }

}
