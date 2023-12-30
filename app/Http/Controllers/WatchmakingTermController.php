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

    public function createForm() {
        return view('create_watchmakingTerm');
    }

    public function create(Request $request)
    {
        $this->validate($request, [
        'term' => 'required',
        'explanation' => 'required',
        ]);

        WatchmakingTerm::create([
            'term' => $request->term,
            'explanation' => $request->explanation,
        ]);

        return redirect('/dictionary')->with('success', 'added');
    }

    public function deleteForm($id)
    {
        $watchmakingTerm = WatchmakingTerm::findOrFail($id);
        return view('delete_watchmakingTerm', compact('watchmakingTerm'));
    }

    public function delete($id)
    {
        $watchmakingTerm = WatchmakingTerm::findOrFail($id);
        $watchmakingTerm->delete();
        return redirect('/dictionary')->with('success', 'Watchmaking term deleted successfully!');
    }
}
