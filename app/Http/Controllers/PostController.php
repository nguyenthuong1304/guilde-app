<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $categoryId = request()->category_id ?? 1;

        $category = Category::with([
            'posts' => fn ($q) => $q->select('id', 'slug', 'name', 'description', 'category_id', 'published_at')->published()->orderBy('id')
        ])->findOrFail($categoryId);

        return view('home', ['data' => $category]);
    }

    public function show(Request $request, $slug)
    {
        return view('post', ['post' => $slug]);
    }
}
