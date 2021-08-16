<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function byCategory($id)
    {
        $category = Category::with([
            'posts',
            'children',
            'children.posts',
        ])->findOrFail($id);

        return view('by-category', compact('category'));
    }
}
