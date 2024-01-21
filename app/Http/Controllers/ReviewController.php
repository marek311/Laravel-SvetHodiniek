<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        return view('reviews', compact('reviews'));
    }
    public function home() {
        $reviews = Review::all();
        return view('home', compact('reviews'));
    }
    public function review($watchName)
    {
        $cleanWatchName = strtolower(str_replace('_', ' ', $watchName));
        $review = Review::with('paragraphs')->where('watch_name', $cleanWatchName)->first();
        if (!$review) abort(404);
        return view('review', ['review' => $review]);
    }
    public function createForm()
    {
        return view('create_review');
    }
    public function create(Request $request)
    {
        $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-z0-9\s.,!?]+$/',
            ],
            'content' => 'array',
            'content.*' => 'required|string|regex:/^[A-Za-z0-9\s.,!?]+$/',
            'pictureFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $watchName = htmlspecialchars($request->input('title'), ENT_QUOTES, 'UTF-8');
        $review = new Review();
        $review->watch_name = $watchName;
        $review->user_id = $request->user()->id;
        if ($request->hasFile('pictureFile')) {
            $file = $request->file('pictureFile');
            $review->pictureFile = file_get_contents($file->getRealPath());
        } else {
            $review->pictureFile = null;
        }
        $review->save();
        if ($request->has('content') && is_array($request->input('content'))) {
            foreach ($request->input('content') as $index => $content) {
                $paragraphText = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
                $review->paragraphs()->create([
                    'paragraph_text' => $paragraphText,
                    'id' => $index + 1,
                ]);
            }
        }
        return redirect()->route('review', ['watchName' => $watchName]);
    }
    public function updateForm($watchName)
    {
        $cleanWatchName = strtolower(str_replace('_', ' ', $watchName));
        $review = Review::with('paragraphs')->where('watch_name', $cleanWatchName)->first();
        if (!$review) abort(404);
        return view('update_review', ['review' => $review]);
    }
    public function update(Request $request, $watchName)
    {
        if (!$request->user()) {
            abort(404);
        }
        $cleanWatchName = strtolower(str_replace('_', ' ', $watchName));
        $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-z0-9\s.,!?]+$/',
            ],
            'content' => 'array',
            'content.*' => 'required|string|regex:/^[A-Za-z0-9\s.,!?]+$/',
            'pictureFile' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $review = Review::with('paragraphs')->where('watch_name', $cleanWatchName)->first();
        if (!$review) {
            abort(404);
        }
        if ($request->user()->id !== $review->user_id && auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $review->update([
            'watch_name' => $request->input('title'),
        ]);
        if ($request->hasFile('pictureFile')) {
            $file = $request->file('pictureFile');
            $review->update(['pictureFile' => file_get_contents($file->getRealPath())]);
        }
        $existingParagraphs = $review->paragraphs->pluck('id')->toArray();
        $requestedParagraphs = array_keys($request->input('content', []));
        $paragraphsToDelete = array_diff($existingParagraphs, $requestedParagraphs);
        $review->paragraphs()->whereIn('id', $paragraphsToDelete)->delete();
        foreach ($request->input('content') as $index => $content) {
            $sanitizedContent = htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
            $review->paragraphs()->updateOrCreate(
                ['id' => $index + 1],
                ['paragraph_text' => $sanitizedContent]
            );
        }
        return redirect()->route('review', ['watchName' => $request->input('title')]);
    }
    public function deleteForm($watchName)
    {
        $cleanWatchName = strtolower(str_replace('_', ' ', $watchName));
        $review = Review::with('paragraphs')->where('watch_name', $cleanWatchName)->first();
        if (!$review) {
            abort(404);
        }
        return view('delete_review', ['review' => $review]);
    }
    public function delete(Request $request, $watchName)
    {
        $cleanWatchName = strtolower(str_replace('_', ' ', $watchName));
        $review = Review::with('paragraphs')->where('watch_name', $cleanWatchName)->first();
        if (!$review) {
            abort(404);
        }
        if ($request->user()->id !== $review->user_id && auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $review->paragraphs()->delete();
        $review->delete();
        return redirect()->route('reviews')->with('success', 'Review deleted successfully!');
    }
    public function createComment(Request $request, $watchName)
    {
        $cleanWatchName = strtolower(str_replace('_', ' ', $watchName));
        $review = Review::where('watch_name', $cleanWatchName)->first();
        if (!$review) {
            abort(404);
        }
        $request->validate([
            'content' => 'required|string|regex:/^[A-Za-z0-9\s.,!?()\'"-]+$/',
        ]);
        $review->comments()->create([
            'content' => htmlspecialchars($request->input('content'), ENT_QUOTES, 'UTF-8'),
            'user_id' => $request->user()->id,
        ]);
        return redirect()->route('review', ['watchName' => $watchName])->with('success', 'Comment added successfully!');
    }
    public function deleteComment($watchName, $commentId)
    {
        $cleanWatchName = strtolower(str_replace('_', ' ', $watchName));
        $review = Review::where('watch_name', $cleanWatchName)->first();
        if (!$review) {
            abort(404);
        }
        $comment = $review->comments()->find($commentId);
        if (!$comment) {
            abort(404);
        }
        if (auth()->user()->id !== $comment->user_id && auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $comment->delete();
        return redirect()->route('review', ['watchName' => $watchName])->with('success', 'Comment deleted successfully!');
    }
    public function show($id)
    {
        $image = Review::find($id);
        if (!$image || !$image->pictureFile) {
            abort(404);
        }
        return response($image->pictureFile)->header('Content-Type', 'image/jpeg');
    }
}
