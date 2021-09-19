<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\AdminCategory;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\Post\AdminPost;
use App\Http\Livewire\Admin\Post\AdminPostIndex;
use App\Http\Livewire\Admin\Post\ImageContent;
use App\Http\Livewire\CategoryDetail;
use App\Http\Livewire\PostIndex;
use App\Http\Livewire\PostDetail;
use App\Http\Livewire\SearchPost;
use App\Models\Post;

Auth::routes();
Route::get('/', PostIndex::class)->name('home');
Route::get('/category/{slug}', CategoryDetail::class)->name('category');
Route::get('bai-viet/{slug}', PostDetail::class)->name('detail');
Route::get('/search', SearchPost::class)->name('search');

Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth',
], function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/categories', AdminCategory::class)->name('category_index');
    Route::group([
        'prefix' => 'posts',
    ], function () {
        Route::get('/image-content', ImageContent::class)->name('image_content');
        Route::get('/', AdminPostIndex::class)->name('post_index');
        Route::get('/new', AdminPost::class)->name('post.create');
        Route::get('/{id}/edit', AdminPost::class)->name('post.edit');
        Route::get('/{slug}', function ($slug) {
            $post = Post::where('slug', $slug)->firstOrFail();

            return view('livewire.admin.post.detail', ['post' => $post]);
        })->name('post.detail');
    });

    Route::get('configurations', \App\Http\Livewire\Admin\ConfigurationSystem::class)->name('configs');
});
