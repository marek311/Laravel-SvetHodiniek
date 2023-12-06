<?php

namespace App\Http\Controllers;

use App\Models\WatchmakingTerm;
use Illuminate\Http\Request;

class WatchmakingTermController extends Controller
{
    public function index()
    {
        $watchmakingTerms = WatchmakingTerm::all();
        return view('dictionary', compact('watchmakingTerms'));
    }
}
