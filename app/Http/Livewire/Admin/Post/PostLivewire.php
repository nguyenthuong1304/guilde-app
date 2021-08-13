<?php

namespace App\Http\Livewire\Admin\Post;

use App\Http\Livewire\Admin\BaseComponent;
use App\Models\Post;

class PostLivewire extends BaseComponent
{
    public string $search = '';
    public function render()
    {
        return view('livewire.admin.post.index', [
            'posts' => Post::with(['category' => fn ($q) => $q->select('id', 'name') ])->where(function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%');
            })->paginate($this->perPage),
        ])
        ->extends($this->extends)
        ->section($this->section);
    }
}
