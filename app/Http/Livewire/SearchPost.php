<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class SearchPost extends Component
{
    public $term;
    public $tag_id;
    protected $queryString = ['term', 'tag_id'];

    public string $orderBy = 'created_at';

    public function render()
    {
        $query = Post::query();

        if ($this->term) {
            $query->search($this->term);
        }

        if ($this->tag_id) {
            $query->leftJoin('post_tags as pt', 'pt.post_id', '=', 'posts.id')
                ->where('pt.tag_id', $this->tag_id);
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
