<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redis;
use Livewire\Component;

class PostDetail extends Component
{
    public $post;

    public $relates = [];

    public function mount($slug)
    {
        $this->post = Post::where([
            'slug' => $slug,
        ])->firstOrFail();
        $this->setHash();
        $this->relates = Post::select('id', 'slug', 'name')->where([
            ['category_id', '=', $this->post->category_id],
            ['id', '>', $this->post->id],
        ])->limit(5)->orderBy('id', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.post-detail', [
            'post' => $this->post,
            'relates' => $this->relates,
        ])
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
