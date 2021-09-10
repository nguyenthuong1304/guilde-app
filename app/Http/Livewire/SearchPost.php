<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Artesaos\SEOTools\Traits\SEOTools;
use Livewire\Component;

class SearchPost extends Component
{
    use SEOTools;

    public $term;
    public $tag;
    protected $queryString = [
        'term' => ['except' => ''],
        'tag' => ['except' => ''],
    ];

    public string $orderBy = 'created_at';

    public function render()
    {
        $this->seo()->setTitle('Chia sẽ lập trình', false);

        $query = Post::query();

        if ($this->term) {
            $query->search($this->term);
        }

        if ($this->tag) {
            $query->leftJoin('post_tags as pt', 'pt.post_id', '=', 'posts.id')
                ->leftJoin('tags as t', 't.id', '=', 'pt.tag_id')
                ->where('t.name', $this->tag);
        }

        $posts = $query->orderBy('posts.'.$this->orderBy, 'desc')
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
