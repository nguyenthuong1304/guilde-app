<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostDetail extends Component
{
    public $post;

    public function mount($id, $slug)
    {
        $this->post = Post::where([
            'slug' => $slug,
            'id' => $id
        ])->firstOrFail();
    }

    public function render()
    {
        return view('livewire.post-detail', ['post' => $this->post])
            ->extends('layouts.app')
            ->section('main');
    }
}
