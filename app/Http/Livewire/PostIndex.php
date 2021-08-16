<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class PostIndex extends Component
{
    public bool $isLoadMore = false;

    public int $numPost = 5;

    public function render()
    {
        $categories = Category::with([
            'posts' => fn ($q) => $q->published()->orderBy('id')->limit($this->numPost),
        ])->whereNull('parent_id')->orderBy('id')->get();

        return view('home', [
            'categories' => $categories,
        ])
            ->extends('layouts.app')
            ->section('main');
    }
}
