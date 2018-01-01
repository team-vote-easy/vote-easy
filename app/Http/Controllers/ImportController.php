<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use File;
use App\CT400;
use Illuminate\Support\Facades\DB;

class ImportController extends Controller
{
	public function showImport(){
		$courses = ["Computer Science", "Computer Technology", "Computer Information Systems"];
		$levels = [100, 200, 300, 400];
		return view('welcome', [
			'courses'=>$courses,
			'levels'=>$levels
		]);
	}

    public function import(Request $request){
    	$extension = File::extension($request->file->getClientOriginalName());
    	$path = $request->file->getRealPath();
    	$data = Excel::load($path, function($reader){
    		
    	})->get();
    	foreach($data as $key=>$value){
    		$student = [
    			'first_name'=>$value->first_name,
    			'last_name'=>$value->last_name,
    			'matric_no'=>$value->matric_no,
    			'course'=>$request->course,
    			'level'=>$request->level
    		];
    		CT400::create($student);
    	}


    	
    }
}
