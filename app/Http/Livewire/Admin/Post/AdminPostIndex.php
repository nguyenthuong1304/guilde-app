<?php

namespace App\Http\Livewire\Admin\Post;

use App\Http\Livewire\Admin\BaseComponent;
use App\Models\Category;
use App\Models\Post;
use Livewire\WithPagination;

class AdminPostIndex extends BaseComponent
{
    use WithPagination;

    protected $listeners = ['deletePost'];

    public string $search = '';
    public string $orderBy = 'created_at';
    public string $order = 'desc';
    public $categories;
    public $category_id;

    protected $queryString = [
        'search' => ['except' => ''],
        'orderBy',
        'category_id' => ['except' => ''],
    ];

    public function mount()
    {
        $this->categories = Category::select('id', 'name')->get();
    }

    public function render()
    {
        return view('livewire.admin.post.index', [
            'posts' => Post::with(['category' => fn ($q) => $q->select('id', 'name') ])->where(function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%');
            })
                ->when($this->category_id, fn ($q) => $q->where('category_id', $this->category_id))
                ->orderBy($this->orderBy, $this->order)
                ->paginate($this->perPage),
        ])
        ->extends($this->extends)
        ->section($this->section);
    }

    public function deletePost($id)
    {
        Post::destroy($id);
    }
}
