<?php

use App\Http\Controllers\PostController;
use App\Http\Livewire\Admin\CategoryLivewire;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\Post\PostDetailLivewire;
use App\Http\Livewire\Admin\Post\PostLivewire;
use App\Http\Livewire\PostDetail;
use App\Models\Post;

Auth::routes();
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/category/{id}', [PostController::class, 'byCategory'])->name('category');
Route::get('/post/{slug}', PostDetail::class)->name('detail');

Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth',
], function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/categories', CategoryLivewire::class)->name('category_index');

    Route::group([
        'prefix' => 'posts',
    ], function () {
        Route::get('/', PostLivewire::class)->name('post_index');
        Route::get('/new', PostDetailLivewire::class)->name('post.create');
        Route::get('/{id}/edit', PostDetailLivewire::class)->name('post.edit');
        Route::get('/{slug}', function ($slug) {
            $post = Post::where('slug', $slug)->firstOrFail();

            return view('livewire.admin.post.detail', ['post' => $post]);
        })->name('post.detail');
    });
});
