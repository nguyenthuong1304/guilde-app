<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostDetail extends Component
{
    public $post;

    public $relates = [];

    public function mount($slug)
    {
        $this->post = Post::where([
            'slug' => $slug,
        ])->firstOrFail();

        $this->relates = Post::select('id', 'slug', 'name')->where([
            ['category_id', '=', $this->post->category_id],
            ['id', '>', $this->post->id],
        ])->limit(5)->orderBy('id', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.post-detail', [
            'post' => $this->post,
            'relates' => $this->relates,
        ])
            ->extends('layouts.app')
            ->section('main');
    }
}
