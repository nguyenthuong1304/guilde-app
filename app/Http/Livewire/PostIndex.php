<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Configuration;
use Livewire\Component;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class PostIndex extends Component
{
    use SEOToolsTrait;

    public bool $isLoadMore = false;

    public int $numPost;

    public $config;

    public function mount()
    {
        $this->config = Configuration::select('title', 'total_post_a_cate')->first();
        $this->numPost = $this->config->total_post_a_cate ?? 5;
    }

    public function render()
    {
        $this->seo()->setTitle($this->config->title ?? 'Chia sẻ và học hỏi', false);
        $this->seo()->setDescription('Trang web nhằm mục đích chia sẽ lập tình miễn phí cho người mới bắt đầu, và chia sẽ kiến thức lập trình đến mọi người');
        $this->seo()->opengraph()->setUrl(request()->url());
        $this->seo()->opengraph()->addProperty('site_name', 'SharingPrograming');
        $this->seo()->opengraph()->addProperty('description', 'Technology Articles Platform from Asia, filled with latest information on Programming Languages and Frameworks. Ruby on Rails / PHP / Swift / Unity / Java /.Net');
        $this->seo()->opengraph()->addProperty('og:locale', 'en-us');
        $this->seo()->opengraph()->addProperty('og:locale', 'vn');
        $this->seo()->twitter()->setSite('@LuizVinicius73');
        $this->seo()->jsonLd()->setType('Article');

        $categories = Category::withCount(['children', 'posts' => fn ($q) => $q->published()])
            ->whereNull('parent_id')
            ->where('show_index_page', 1)
            ->orderBy('order')
            ->get();

        $categories->each(fn ($cate) => $cate->load([
            'posts' => fn ($q) => $q->published()->orderBy('id')->take($this->numPost),
        ]));

        return view('home', [
            'categories' => $categories,
        ])
            ->extends('layouts.app')
            ->section('main');
    }
}
