<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, Search;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'content',
        'image',
        'category_id',
        'published',
        'views',
        'published_at',
        'next_id',
        'prev_id',
        'user_id',
    ];

    protected $searchable = [
        'name',
        'description',
        'slug',
    ];

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($post) {
            $post->prevPost?->update(['next_id' => null]);
            $post->nextPost?->update(['prev_id' => null]);
        });
    }

    public function getImageShowAttribute()
    {
        return $this->image ? asset('storage/'.$this->image) : '/images/no-image.png';
    }

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    public function prevPost()
    {
        return $this->belongsTo(self::class, 'prev_id');
    }

    public function nextPost()
    {
        return $this->belongsTo(self::class, 'next_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
