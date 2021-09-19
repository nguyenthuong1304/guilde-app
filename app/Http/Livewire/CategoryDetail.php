<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Configuration;
use Artesaos\SEOTools\Traits\SEOTools;
use Livewire\Component;

class CategoryDetail extends Component
{
    use SEOTools;

    public Category $category;

    public function mount($slug)
    {
        $this->category = Category::with([
            'posts' => fn ($q) => $q->published(),
            'children' => fn ($q) => $q->withCount(['posts' => fn ($q) => $q->published()]),
            'children.posts' => fn ($q) => $q->published(),
        ])->withCount([
            'posts' => fn ($q) => $q->published(),
        ])->where('slug', $slug)->firstOrFail();

        $config = Configuration::select('title')->first();
        $this->seo()->setTitle($config->title . ' - ' . $this->category->name ?? 'Chia sẻ và học hỏi', false);
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
