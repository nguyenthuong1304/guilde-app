<?php

namespace App\Http\Livewire\Component;

use App\Models\Post;
use Livewire\Component;

class SearchAll extends Component
{
    public string $term = '';

    public function render()
    {
        $query = Post::select('id', 'slug', 'name');

        if ($this->term) {
            $query->search($this->term);
        }
        $posts = $query->where('published', true)
            ->orderBy('views')
            ->paginate(5);

        return view('livewire.component.search-all', [
            'posts' => $posts
        ]);
    }
}
