<?php

namespace App\Http\Livewire;

use App\Models\Configuration;
use App\Models\Post;
use Artesaos\SEOTools\Traits\SEOTools;
use Livewire\Component;
use Livewire\WithPagination;

class SearchPost extends Component
{
    use SEOTools, WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $term;
    public $tag;
    protected $queryString = [
        'term' => ['except' => ''],
        'tag' => ['except' => ''],
    ];

    public string $orderBy = 'created_at';

    public function render()
    {
        $config = Configuration::select('title')->first();
        $this->seo()->setTitle($config->title ?? 'Chia sẻ và học hỏi', false);

        $query = Post::query();

        if ($this->term) {
            $query->search($this->term, 'posts');
        }

        if ($this->tag) {
            $query->whereHas('tags', function ($q) {
                return $q->where('tags.name', 'like', "%$this->tag%");
            });
        }

        $posts = $query->where('posts.published', true)
            ->orderBy('posts.'.$this->orderBy, 'desc')
            ->paginate(40);

        return view('livewire.search-post', compact('posts'))
            ->extends('layouts.app')
            ->section('main');
    }

    public function updateOrderBy($orderBy)
    {
        if ($orderBy == $this->orderBy) {
            return;
        }

        $this->orderBy = $orderBy;
    }
}
