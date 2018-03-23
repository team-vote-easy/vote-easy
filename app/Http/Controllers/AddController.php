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
		$levels = [100, 200, 300, 400];
		$positions = ["PRO", "President", "Vice President", "Chaplain", "Director of Sports", "Director of Social", "General Secretary", "Director of Transport", "Treasurer", "Director of Finance", "Director of Welfare", "Senate President", "Sargent At Arms", "Assistant Gen Secretary", "Senator Chief Whip", "Deputy Senate President", "Senate Scribe", "Hall Senator"];
        $halls = ["Samuel Akande", "Queen Esther", "Nelson Mandela", "Bethel Splendor", "Kings Delight Hall", "Winslow", "Gideon Troopers", "Welch", "Crystal", "Platinum", "Marigold", "FAD", "Queen Esther", "Off-Campus"];
        $floors=["Ground Floor", "First Floor", "Second Floor", "Third Floor"];
        sort($positions);
        sort($halls);
        sort($floors);
        return view('add-candidates', [
			'levels'=>$levels,
			'positions'=>$positions,
            'admin'=>$admin,
            'halls'=>$halls,
            'floors'=>$floors
		]);
    }

    public function add(Request $request){
        $image = $request->file('image');
        $extension = $image->extension();
        $random = str_random(6);
        $fileName = "{$request->firstName}_{$random}.jpg";
        $image->move(public_path().'/candidate-images', $fileName);

        $floor = $request->floor ? $request->floor : null;
        $hall = $request->hall ? $request->hall : null;

    	$candidate = Candidate::create([
    		'first_name'=>$request->firstName,
    		'last_name'=>$request->lastName,
    		'level'=>$request->level,
            'hall'=>$hall,
            'floor'=>$floor,
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
