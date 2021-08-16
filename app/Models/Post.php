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
    ];

    protected $searchable = [
        'name',
        'description',
        'slug',
    ];

    public function getImageAttribute($value)
    {
        return $value ? asset('storage/'.$value) : '/images/no-image.png';
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
}
