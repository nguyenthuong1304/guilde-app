<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class CardPost extends Component
{
    public Post $post;

    public function render()
    {
        return view('livewire.card-post', ['post' => $this->post]);
    }
}
