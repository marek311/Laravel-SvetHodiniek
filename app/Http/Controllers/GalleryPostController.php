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
            'name' => 'required',
            'picture' => 'required|url',
        ]);
        GalleryPost::create([
            'name' => $request->name,
            'picture' => $request->picture,
        ]);
        return redirect('/gallery')->with('success', 'Gallery post added successfully!');
    }
    public function updateForm($id)
    {
        $galleryPost = GalleryPost::findOrFail($id);
        return view('update_galleryPost', compact('galleryPost'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'picture' => 'required|url',
        ]);
        $galleryPost = GalleryPost::findOrFail($id);
        $galleryPost->update([
            'name' => $request->name,
            'picture' => $request->picture,
        ]);
        return redirect('/gallery')->with('success', 'Gallery post updated successfully!');
    }
    public function deleteForm($id)
    {
        $galleryPost = GalleryPost::findOrFail($id);
        return view('delete_galeryPost', compact('galleryPost'));
    }
    public function delete($id)
    {
        $galleryPost = GalleryPost::findOrFail($id);
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
