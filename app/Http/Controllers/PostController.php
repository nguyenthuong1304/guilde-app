<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function byCategory($id)
    {
        $category = Category::with('posts')->findOrFail($id);

        return view('by-category', compact('category'));
    }
}
