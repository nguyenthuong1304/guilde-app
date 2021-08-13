<?php

namespace App\Http\Livewire\Component;

use App\Models\Post;
use Livewire\Component;

class PostDetail extends Component
{
    public Post $post;

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.component.post-detail');
    }
}
