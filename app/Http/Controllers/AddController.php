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
		$positions = ["President", "Vice President (Main)", "Vice President (Iperu)", "General Secretary", "Assistant General Secretary", "Treasurer", "Director of Financial Records", "Director of Public Relations (Main)", "Director of Public Relations (Iperu)", "Director of Socials (Main)", "Director of Socials (Iperu)", "Director of Sports (Main)", "Director of Sports (Iperu)", "Director of Transport and Ventures (Main)", "Director of Transport and Ventures (Iperu)", "Director of Welfare (Main)", "Director of Welfare (Iperu)", "Sergeant At Arms", "Chaplain", "Hall Senator"];

        $halls = ["Samuel Akande", "Queen Esther", "Nelson Mandela", "Bethel Splendor", "Neal Wilson", "Nyberg", "Ogden", "Winslow", "Gideon Troopers", "Welch", "Crystal", "Platinum", "Felicia Adebisi Dada (FAD)", "Queen Esther", "Off-Campus", "Ameyo Adadevoh", "Gamaliel 1", "Gamaliel 2", "Havilah Gold", "Justice Deborah", "White"];

        $blocks = ["GF", "FF", "TF", "SF", "A", "B", "C", "D", "E", "F", "G", "H", "100", "200", "300", "400"];
        sort($positions);
        sort($halls);
        sort($blocks);
        return view('add-candidates', [
			'levels'=>$levels,
			'positions'=>$positions,
            'admin'=>$admin,
            'halls'=>$halls,
            'blocks'=>$blocks
		]);
    }

    public function add(Request $request){
        $image = $request->file('image');
        $extension = $image->extension();
        $random = str_random(6);
        $fileName = "{$request->firstName}_{$random}.jpg";
        $image->move(public_path().'/candidate-images', $fileName);

        $block = $request->block ? $request->block : null;
        $hall = $request->hall ? $request->hall : null;

    	$candidate = Candidate::create([
    		'first_name'=>$request->firstName,
    		'last_name'=>$request->lastName,
    		'level'=>$request->level,
            'hall'=>$hall,
            'block'=>$block,
    		'position'=>$request->position,
    		'image'=>$fileName
    	]);

    	return response()->json($candidate, 200);
    }

    
}
