<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;

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
        if($request->course=='All' && $request->level=='All'){
            $students = Student::all();
            $count = count($students);
            $response = [
                'message'=> "There are {$count} students in Total",
                'students'=> $students
            ];
            return response()->json($response);
        }

        if($request->level=='All'){
            $students = Student::course($request->course)->get();
            $count = count($students);
            $response = [
                'message'=> "There are {$count} {$request->course} students in Total",
                'students'=> $students
            ];
            return response()->json($response);
        }

        if($request->course=='All'){
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
