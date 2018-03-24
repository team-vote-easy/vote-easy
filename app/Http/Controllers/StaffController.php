<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Staff;

use Auth;

use Hash;

class StaffController extends Controller
{
   	public function addStaffView(){
   		$admin = Auth::guard('admin')->user()->name;
   		$halls = ["Samuel Akande", "Queen Esther", "Nelson Mandela", "Bethel Splendor", "Kings Delight Hall", "Winslow", "Gideon Troopers", "Welch", "Crystal", "Platinum", "Marigold", "FAD", "Queen Esther", "Off-Campus"];

   		return view('add-staff', [
   			'admin'=>$admin,
   			'halls'=>$halls

   		]);
   	} 

   	public function addStaff(Request $request){
   		$existingStaff = Staff::where('hall', $request->hall)->first();
   		if($existingStaff){
   			return response()->json("Sorry a staff for $request->hall already exists!", 500);
   		}

   		$randomString = str_random(5);
   		$key = str_replace(' ', '-', strtolower($request->hall));
   		$key = "$key-$randomString";
   		$staff = Staff::create([
			'first_name'=>$request->firstName,
			'last_name'=>$request->lastName,
			'username'=>$request->username,
			'phone'=>$request->phone,
			'hall'=>$request->hall,
			'key'=>$key,
			'password'=>Hash::make($key)
   		]);

   		if($staff){
   			return response()->json($staff, 200);
   		} else{
   			return response()->json("Sorry couldnt create the staff!", 500);
   		}
   	}
}
