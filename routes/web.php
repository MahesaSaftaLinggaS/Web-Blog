<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\PostIndex;
use App\Livewire\Admin\PostForm;

// Rute halaman publik (home)
Route::get('/', function () {
    $query = request('search');

    $posts = Post::latest()
        ->when($query, function ($q) use ($query) {
            $q->where('title', 'like', "%{$query}%")
                ->orWhere('content', 'like', "%{$query}%");
        })
        ->paginate(5); //


    return view('public.index', compact('posts'));
})->name('public.home');

// Rute detail artikel
Route::get('/posts/{slug}', function ($slug) {
    $post = Post::where('slug', $slug)->firstOrFail();
    return view('public.show', compact('post'));
})->name('public.posts.show');

// Rute dashboard & profile
Route::view('/dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');
Route::view('/profile', 'profile')->middleware(['auth'])->name('profile');

// Rute admin (hanya jika login)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/posts', PostIndex::class)->name('admin.posts');
    Route::get('/admin/posts/create', PostForm::class)->name('admin.posts.create');
    Route::get('/admin/posts/edit/{id}', PostForm::class)->name('admin.posts.edit'); // tambahkan juga edit
});

// Rute autentikasi (dari Laravel Breeze/Fortify)
require __DIR__ . '/auth.php';
