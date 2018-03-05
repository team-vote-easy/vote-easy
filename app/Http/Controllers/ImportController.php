<?php

namespace App\Http\Controllers;

set_time_limit(0);

use Illuminate\Http\Request;
use Excel;
use File;
use Hash;
use App\Student;
use Illuminate\Database\QueryException;

class ImportController extends Controller
{
	public function showImport(){
		$courses = ["Computer Science", "Computer Technology", "Computer Information Systems"];
		$levels = [100, 200, 300, 400];
		return view('import', [
			'courses'=>$courses,
			'levels'=>$levels
		]);
	}

    public function import(Request $request){
        $counter = 0;
    	$extension = File::extension($request->file->getClientOriginalName());
    	$path = $request->file->getRealPath();
    	$data = Excel::load($path, function($reader){

        })->get();

    	foreach($data as $key=>$value){
            $key = strtolower(str_random(6));

    		$student = [
    			'name'=>$value->name,
    			'matric_no'=>$value->matric_no,
    			'course'=>$request->course,
                'key'=>$key,
                'password'=> Hash::make($key),
    			'level'=>$request->level
    		];

    		try{
                Student::create($student);
                $counter+=1;
            } 
            catch(QueryException $e){
                if($e->errorInfo[1]==1062){
                    $errorString = $e->errorInfo[2];
                    preg_match('/..(\/)..../', $errorString, $duplicate_matric);
                    $existing_student = Student::where('matric_no', $duplicate_matric[0])->first();
                    $message = "Oops! An error occured while adding the student {$student['name']}. The matric number {$duplicate_matric[0]} already belongs to {$existing_student->name}, a {$existing_student->level} level student in {$existing_student->course}";
                    return response()->json([
                        'status'=>'error',
                        'message'=>$message
                    ], 404);
                }
            }
    	}
        return 'Successfully Added '.$counter.' '.$request->course.' students';
    }
}
