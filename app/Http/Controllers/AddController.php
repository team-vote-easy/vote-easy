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
        $blocks = ["First Floor", "Second Floor", "Third Floor", "A", "B", "C", "D", "E", "F", "G", "H"];
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
