<?php

namespace App\Http\Controllers;

use App\Models\GalleryPost;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GalleryPostController extends Controller
{
    public function index()
    {
        $galleryPosts = GalleryPost::all();
        return view('gallery', compact('galleryPosts'));
    }
    public function createForm()
    {
        return view('create_galleryPost');
    }
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'picture' => 'required|url',
        ]);
        $validatedUrl = filter_var($request->picture, FILTER_VALIDATE_URL);
        if (!$validatedUrl) {
            return redirect('/gallery')->withErrors(['Invalid URL provided.']);
        }
        $galleryPost = new GalleryPost([
            'name' => $request->name,
            'picture' => $validatedUrl,
        ]);
        $galleryPost->user()->associate($request->user());
        $galleryPost->save();
        return redirect('/gallery')->with('success', 'Gallery post added successfully!');
    }
    public function updateForm($id)
    {
        $galleryPost = GalleryPost::findOrFail($id);
        return view('update_galleryPost', compact('galleryPost'));
    }
    public function update(Request $request, $id)
    {
        if (!$request->user()) {
            abort(404);
        }
        $this->validate($request, [
            'name' => 'required|string',
            'picture' => 'required|url',
        ]);
        $validatedUrl = filter_var($request->picture, FILTER_VALIDATE_URL);
        if (!$validatedUrl) {
            return redirect('/gallery')->withErrors(['Invalid URL provided.']);
        }
        $galleryPost = GalleryPost::findOrFail($id);
        if (!$galleryPost) {
            abort(404);
        }
        if ($request->user()->id !== $galleryPost->user_id && $request->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $galleryPost->update([
            'name' => $request->name,
            'picture' => $validatedUrl,
        ]);
        return redirect('/gallery')->with('success', 'Gallery post updated successfully!');
    }
    public function deleteForm($id)
    {
        $galleryPost = GalleryPost::findOrFail($id);
        if (!$galleryPost) {
            abort(404);
        }
        return view('delete_galleryPost', compact('galleryPost'));
    }
    public function delete($id)
    {
        $galleryPost = GalleryPost::findOrFail($id);
        if (!$galleryPost) {
            abort(404);
        }
        if (auth()->user()->id !== $galleryPost->user_id && auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }
        $galleryPost->delete();
        return redirect('/gallery')->with('success', 'Gallery post deleted successfully!');
    }
    public function fetchMoreImages(Request $request)
    {
        $count = $request->input('count', 1);
        $offset = $request->input('offset', 0);
        $totalImages = GalleryPost::count();
        $moreImages = GalleryPost::skip($offset)->take($count)->get();
        return response()->json(['images' => $moreImages, 'total' => $totalImages]);
    }
}
