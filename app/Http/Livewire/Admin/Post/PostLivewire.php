<?php

namespace App\Http\Livewire\Admin\Post;

use App\Http\Livewire\Admin\BaseComponent;
use App\Models\Post;
use Livewire\WithPagination;

class PostLivewire extends BaseComponent
{
    use WithPagination;

    public string $search = '';
    public string $orderBy = 'created_at';
    public string $order = 'asc';

    protected $queryString = ['search', 'orderBy'];

    public function render()
    {
        return view('livewire.admin.post.index', [
            'posts' => Post::with(['category' => fn ($q) => $q->select('id', 'name') ])->where(function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%');
            })
                ->orderBy($this->orderBy, $this->order)
                ->paginate($this->perPage),
        ])
        ->extends($this->extends)
        ->section($this->section);
    }
}
