<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;

use App\Candidate;

use App\Post;

use File;

use Auth;

class AddController extends Controller
{
    public function showAdd(){
        $admin = Auth::guard('admin')->user()->name;
    	$courses = ["Computer Science", "Computer Technology", "Computer Information Systems"];
		$levels = [100, 200, 300, 400];
		$positions = ["PRO", "President", "Vice President", "Chaplain", "Sports Director", "Social Director"];
		return view('add-candidates', [
			'courses'=>$courses,
			'levels'=>$levels,
			'positions'=>$positions,
            'admin'=>$admin
		]);
    }

    public function add(Request $request){
        $image = $request->file('image');
        $extension = $image->extension();
        $random = str_random(6);
        $fileName = "{$request->firstName}_{$random}.jpg";
        $image->move(public_path().'/candidate-images', $fileName);

    	$candidate = Candidate::create([
    		'first_name'=>$request->firstName,
    		'last_name'=>$request->lastName,
    		'level'=>$request->level,
    		'course'=>$request->course,
    		'position'=>$request->position,
    		'image'=>$fileName
    	]);

    	return response()->json($candidate, 200);
    }

    public function addPostsView(){
        return view('add-post-view');
    }

    public function addPosts(Request $request){
        $postExists = Post::where('post', $request->post)->first();
        if($postExists){
            return response()->json('Sorry! Post Exists already!', 513);
        }

        $newPost = Post::create([
            'post'=>$request->post
        ]);

        if($newPost){
            return response()->json("Successfully Added Post: {$newPost->post}");
        }
    }

    
}
