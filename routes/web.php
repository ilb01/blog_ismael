<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

// Rutas de recursos
Route::resource('categories', CategoryController::class);
Route::resource('tags', TagController::class);
Route::resource('posts', PostController::class);
Route::resource('comments', CommentController::class);
Route::post('/comments/{comment}/add-image', [CommentController::class, 'addImage'])->name('comment.addImage');

Route::get('/', function () {
    $posts = Post::all();
    return view('blog', compact('posts'));
})->name('home');

Route::get('/search', [PostController::class, 'search'])->name('search');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('comments', CommentController::class);
});

require __DIR__.'/auth.php';
