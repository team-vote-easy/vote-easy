<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Student;

use App\Candidate;

use App\Vote;

use App\Post;

class VoteController extends Controller
{
    public function test(){
        $candidate = Candidate::where('id', 7)->first();
        dd($candidate->votes->count);
    }
}
