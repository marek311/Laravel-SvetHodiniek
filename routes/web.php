<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\GalleryPostController;
use App\Http\Controllers\WatchmakingTermController;

Route::get('aboutUs', function () {
    return view('aboutUs');
});

Route::get('discussion', function () {
    return view('discussion');
});

Route::get('loginRegister', function () {
    return view('loginRegister');
});

Route::get('loginTab', function () {
    return view('loginTab');
});

Route::get('registerTab', function () {
    return view('registerTab');
});


Route::get('dictionary',
    [WatchmakingTermController::class, 'index'])->name('dictionary');


Route::get('/',
    [ReviewController::class, 'home'])->name('home');

Route::get('/reviews',
    [ReviewController::class, 'index'])->name('reviews');

Route::get('/reviews/{watchName}',
    [ReviewController::class, 'review'])->name('review');

Route::get('/edit/{watch_name}',
    [ReviewController::class, 'updateForm'])->name('review.updateForm');

Route::put('/update/{watch_name}',
    [ReviewController::class, 'update'])->name('review.update');

Route::get('/create',
    [ReviewController::class, 'createForm'])->name('review.createForm');

Route::post('/create',
    [ReviewController::class, 'create'])->name('review.create');

Route::get('/reviews/delete/{watch_name}',
    [ReviewController::class, 'deleteForm'])->name('review.deleteForm');

Route::delete('/reviews/delete/{watch_name}',
    [ReviewController::class, 'delete'])->name('review.delete');


Route::post('/reviews/{watchName}/comments',
    [ReviewController::class, 'createComment'])->name('comment.create');

Route::delete('/reviews/{watchName}/comments/{commentId}',
    [ReviewController::class, 'deleteComment'])->name('comment.delete');



Route::get('gallery',
    [GalleryPostController::class, 'index'])->name('gallery');

Route::get('/gallery/add',
    [GalleryPostController::class, 'createForm'])->name('gallery.createForm');

Route::post('/gallery/add',
    [GalleryPostController::class, 'create'])->name('gallery.create');

Route::get('/gallery/{id}/edit',
    [GalleryPostController::class, 'updateForm'])->name('gallery.updateForm');

Route::put('/gallery/{id}',
    [GalleryPostController::class, 'update'])->name('gallery.update');

Route::get('/gallery/delete/{id}/confirm',
    [GalleryPostController::class, 'deleteForm'])->name('gallery.deleteForm');

Route::delete('/gallery/delete/{id}',
    [GalleryPostController::class, 'delete'])->name('gallery.delete');
