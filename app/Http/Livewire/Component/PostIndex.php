<?php

namespace App\Http\Livewire\Component;

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
        ])->withCount('posts')->get();

        return view('livewire.component.post-index', [
            'categories' => $categories,
        ]);
    }
}
