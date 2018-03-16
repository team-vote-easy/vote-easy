<?php

namespace App\Http\Controllers;


use App\Admin;

use Illuminate\Http\Request;

use Hash;

use Auth;


class AdminController extends Controller
{
    public function create(){
    	Admin::create([
    		'name'=>'darthchudi',
    		'password'=> Hash::make('unicornspooptoo')
    	]);
    	echo 'Done Bitch 🏄🏾';
    }	


    public function showLogin(){
    	return view('admin-login');
    }

    public function login(Request $request){
    	$rules = [
    		'name'=> 'required', 
    		'password'=>'required'
    	];

    	 $messages = [
            'name.required' => "Please enter a name!",
            'password.required'=> 'Please enter a password!'
        ];

    	$this->validate($request, $rules, $messages);

    	if(Auth::guard('admin')->attempt(['name'=>$request->name, 'password'=>$request->password])){
    		return redirect('/import');
    	}
    	else{
    		return redirect()->back()->withInput($request->except('password'))->withErrors(['invalid'=>'Invalid name or password']);
    	}
    }

    public function logout(){
    	Auth::guard('admin')->logout();
    	return redirect('/admin-log');
    }
}
