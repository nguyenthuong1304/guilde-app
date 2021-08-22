<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Traits\SEOTools;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;
use Livewire\Component;

class PostDetail extends Component
{
    use SEOTools;

    public $post;

    public $relates;

    public $mostPosts;

    public bool $readyToLoad = false;

    protected $listeners = ['loadPost'];

    public function mount($slug)
    {
        $this->post = Post::where([
            'slug' => $slug,
        ])->with('tags:name')->firstOrFail();
        $this->setHash();

        $this->seo()->setTitle($this->post->name, false);
        $keyWords = $this->post->tags->pluck('name')->implode(', ');
        SEOMeta::setTitle($this->post->name, false);
        SEOMeta::setDescription($this->post->description);
        SEOMeta::addMeta('article:published_time', $this->post->published_at->toW3CString(), 'property');
        SEOMeta::addMeta('article:section', $this->post->category->name, 'property');
        SEOMeta::addKeyword($keyWords);

        OpenGraph::setDescription($this->post->description);
        OpenGraph::setTitle($this->post->name);
        OpenGraph::setUrl(request()->url());
        OpenGraph::addImage(asset('images/banner.jpeg'));
        OpenGraph::addProperty('locale', 'vn-vn');
        OpenGraph::addProperty('locale:alternate', ['vn-vn', 'en-us']);

        JsonLd::setTitle($this->post->name);
        JsonLd::setDescription($this->post->resume);
        JsonLd::setType('Article');
        JsonLd::addImage($this->post->show_image);

        $this->relates = [];
        $this->mostPosts = [];
    }

    public function render()
    {
        if ($this->readyToLoad) {
            $this->relates = Post::select('id', 'slug', 'name', 'created_at', 'views')->where([
                ['category_id', '=', $this->post->category_id],
                ['id', '!=', $this->post->id],
            ])
                ->limit(4)
                ->orderBy('id', 'asc')
                ->get();

            $this->mostPosts = Post::select('id', 'slug', 'name', 'created_at', 'views')->where([
                ['id', '!=', $this->post->id],
            ])
                ->whereNotIn('id', $this->relates->pluck('id'))
                ->limit(4)
                ->orderBy('views', 'desc')
                ->get();
        }

        return view('livewire.post-detail')
            ->extends('layouts.app')
            ->section('main');
    }

    public function setHash()
    {
        $key = request()->ip . request()->server('HTTP_USER_AGENT').'POST_'.$this->post->id;
        $data = Redis::hgetall(md5($key));
        if (isset($data['time']) && now()->lte(Carbon::parse($data['time']))) {
            return;
        }

        $this->saveRedis($key);
    }

    public function loadPost()
    {
        $this->readyToLoad = true;
        $this->emit('refresh');
    }

    private function saveRedis($key) {
        $newData = [
            'post_id' => $this->post->id,
            'time' => now()->addHours(12),
        ];
        $this->post->increment('views');
        $this->post->save();
        Redis::hmset(md5($key), $newData);
    }
}
