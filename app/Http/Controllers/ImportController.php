<?php

namespace App\Http\Controllers;

set_time_limit(0);

use Illuminate\Http\Request;

use Excel;

use File;

use Hash;

use Auth;

use App\Student;

use Illuminate\Database\QueryException;

class ImportController extends Controller
{
	public function showImport(){
        $admin = Auth::guard('admin')->user()->name;
		$courses = ["Computer Science", "Computer Technology", "Computer Information Systems"];
        $halls = ["Samuel Akande", "Queen Esther", "Nelson Mandela", "Bethel Splendor", "Kings Delight Hall", "Winslow", "Gideon Troopers", "Welch", "Crystal", "Platinum", "Marigold", "FAD", "Queen Esther", "Off-Campus"];
		$levels = [100, 200, 300, 400];
		return view('import', [
			'courses'=>$courses,
			'levels'=>$levels,
            'admin'=>$admin,
            'halls'=>$halls
		]);
	}

    public function addTest(){
        $key = str_random(6);
        $student = Student::create([
            'name'=>'Shaku Shaku',
            'matric_no'=>'14/1000',
            'course'=> null,
            'hall'=>'Gideon Troopers',
            'level'=>null,
            'key'=>$key,
            'password'=>Hash::make($key)
        ]);

        return $student;
    }

    public function import(Request $request){
        $hall = $request->hall == null ? 'Off-Campus' : $request->hall;
        $existingStudents = [];
        $addedStudents = 0;
        $skippedStudents = 0;
        $extension = File::extension($request->file->getClientOriginalName());
        $path = $request->file->getRealPath();
        $data = Excel::load($path, function($reader){  })->get();

    	foreach($data as $key=>$value){
            if($value->name == '' && $value->matric_no == '' && $value->block == ''){
                break;
            }

            $existingStudent = Student::where('matric_no', $value->matric_no)->first();
            if($existingStudent){
                $existingStudents[] = $existingStudent;
                continue;
            }

            if($value->matric_no=='' || $value->matric_no==' ' || !isset($value->matric_no)){
                $newMatric = strtolower($value->name);
                $newMatric = explode(' ', $newMatric);
                $value->matric_no = "$newMatric[0]-$newMatric[1]";
            }

            if($value->name=='' || $value->name==''){
                $skippedStudents+=1;
                continue;
            }

            $key = strtolower(str_random(6));
    		$student = [
    			'name'=>title_case($value->name),
    			'matric_no'=>$value->matric_no,
                'key'=>$key,
                'hall'=>$hall,
                'block'=>$value->block,
                'password'=> Hash::make($key),
    		];

            Student::create($student);
            $addedStudents+=1;
    	}

        if($addedStudents==0){
            return response()->json([
                "message"=>"Sorry! No students could be added!"
            ], 500);
        }

        return response()->json([
            "hall"=>$hall,
            "addedStudents"=>$addedStudents,
            "skippedStudents"=>$skippedStudents,
            "duplicates"=>$existingStudents
        ], 200);
    }


    public function addStudentView(){
        $admin = Auth::guard('admin')->user()->name;
        $halls = ["Samuel Akande", "Queen Esther", "Nelson Mandela", "Bethel Splendor", "Kings Delight Hall", "Winslow", "Gideon Troopers", "Welch", "Crystal", "Platinum", "Marigold", "FAD", "Queen Esther", "Off-Campus"];
        $blocks = ["First Floor", "Second Floor", "Third Floor", "A", "B", "C", "D", "E", "F", "G", "H"];
        return view('add-a-student', [
            'admin'=>$admin,
            'halls'=>$halls,
            'blocks'=>$blocks
        ]);
    }

    public function addStudent(Request $request){
        if(Student::where('matric_no', $request->matricNumber)->first()){
            return response()->json("Student exists already", 500);
        }
        $name = "$request->firstName $request->lastName";
        $name = title_case($name);
        $key = strtolower(str_random(6));
        Student::create([
            'name'=>$name,
            'matric_no'=>$request->matricNumber,
            'key'=>$key,
            'password'=> Hash::make($key),
            'hall'=>$request->hall,
            'block'=>$request->block
        ]);
        return response()->json('Added the student', 200);
        
    }
}
