<?php

namespace App\Http\Livewire\Component;

use App\Models\Post;
use Livewire\Component;

class CardPost extends Component
{
    public Post $post;

    public function render()
    {
        return view('livewire.component.card-post', ['post' => $this->post]);
    }
}
