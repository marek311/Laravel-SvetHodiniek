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
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
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
        if (!$watchmakingTerm) {
            abort(404);
        }
        return view('delete_watchmakingTerm', compact('watchmakingTerm'));
    }
    public function delete($id)
    {
        $watchmakingTerm = WatchmakingTerm::findOrFail($id);
        if (!$watchmakingTerm) {
            abort(404);
        }
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $watchmakingTerm->delete();
        return redirect('/dictionary')->with('success', 'Watchmaking term deleted successfully!');
    }
    public function getTermDetails($id)
    {
        $term = WatchmakingTerm::findOrFail($id);
        return response()->json([
            'term' => $term->term,
            'explanation' => $term->explanation,
        ]);
    }

    public function updateTerm(Request $request, $id)
    {
        $term = WatchmakingTerm::findOrFail($id);

        // Validate and update the term data
        $this->validate($request, [
            'term' => 'required',
            'explanation' => 'required',
        ]);

        $term->update([
            'term' => $request->term,
            'explanation' => $request->explanation,
        ]);

        return response()->json(['success' => true]);
    }
}
