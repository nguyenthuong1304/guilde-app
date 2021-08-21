<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class PostIndex extends Component
{
    use SEOToolsTrait;

    public bool $isLoadMore = false;

    public int $numPost = 5;

    public function render()
    {
        $this->seo()->setTitle('Chia sẽ lập trình', false);
        $this->seo()->setDescription('Trang web nhằm mục đích chia sẽ lập tình miễn phí cho người mới bắt đầu, và chia sẽ kiến thức lập trình đến mọi người');
        $this->seo()->opengraph()->setUrl(request()->url());
        $this->seo()->opengraph()->addProperty('site_name', 'SharingPrograming');
        $this->seo()->opengraph()->addProperty('description', 'Technology Articles Platform from Asia, filled with latest information on Programming Languages and Frameworks. Ruby on Rails / PHP / Swift / Unity / Java /.Net');
        $this->seo()->opengraph()->addProperty('og:locale', 'en-us');
        $this->seo()->opengraph()->addProperty('og:locale', 'vn');
        $this->seo()->twitter()->setSite('@LuizVinicius73');
        $this->seo()->jsonLd()->setType('Article');

        $categories = Category::with([
            'posts' => fn ($q) => $q->published()->orderBy('id')->limit($this->numPost),
        ])->withCount('children')
            ->whereNull('parent_id')
            ->where('show_index_page', 1)
            ->orderBy('id')
            ->get();

        return view('home', [
            'categories' => $categories,
        ])
            ->extends('layouts.app')
            ->section('main');
    }
}
