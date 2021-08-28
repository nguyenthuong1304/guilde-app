<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Artesaos\SEOTools\Traits\SEOTools;
use Livewire\Component;

class CategoryDetail extends Component
{
    use SEOTools;

    public Category $category;

    public function mount($id)
    {
        $this->category = Category::with([
            'posts' => fn ($q) => $q->published(),
            'children',
            'children.posts' => fn ($q) => $q->published(),
        ])->findOrFail($id);

        $this->seo()->setTitle('Chia sẽ lập trình', false);
        $this->seo()->setDescription('Trang web nhằm mục đích chia sẽ lập tình miễn phí cho người mới bắt đầu, và chia sẽ kiến thức lập trình đến mọi người');
        $this->seo()->opengraph()->setUrl(request()->url());
    }
    public function render()
    {
        return view('livewire.category')
            ->extends('layouts.app')
            ->section('main');
    }
}
