<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class SearchPost extends Component
{
    public string $term;

    public string $orderBy = 'created_at';

    public function mount()
    {
        $this->term = request()->get('search') ?? '';
    }

    public function render()
    {
        $query = Post::query();

        if ($this->term) {
            $query->search($this->term);
        }
        $posts = $query->orderBy($this->orderBy, 'desc')
            ->paginate(40);

        return view('livewire.search-post', compact('posts'))
            ->extends('layouts.app')
            ->section('main');
    }

    public function updateOrderBy($orderBy)
    {
        if ($orderBy == $this->orderBy) {
            return;
        }

        $this->orderBy = $orderBy;
    }
}
