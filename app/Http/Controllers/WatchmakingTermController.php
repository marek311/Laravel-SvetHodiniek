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
            'term' => 'required|string|regex:/^[A-Za-z0-9\s]+$/',
            'explanation' => 'required|string|regex:/^[A-Za-z0-9\s]+$/',
        ]);
        $term = htmlspecialchars($request->term, ENT_QUOTES, 'UTF-8');
        $explanation = htmlspecialchars($request->explanation, ENT_QUOTES, 'UTF-8');
        WatchmakingTerm::create([
            'term' => $term,
            'explanation' => $explanation,
        ]);
        return redirect('/dictionary')->with('success', 'Watchmaking Term added successfully!');
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
        return redirect('/dictionary')->with('success', 'Watchmaking Term deleted successfully!');
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
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $term = WatchmakingTerm::findOrFail($id);
        $this->validate($request, [
            'explanation' => 'required|string|regex:/^[A-Za-z0-9\s]+$/',
        ]);
        $explanation = htmlspecialchars($request->explanation, ENT_QUOTES, 'UTF-8');
        $term->update([
            'explanation' => $explanation,
        ]);
        return response()->json(['message' => 'Watchmaking Term updated successfully']);
    }
}
