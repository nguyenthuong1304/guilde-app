<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'banner',
        'favicon',
        'total_post_a_cate',
        'facebook_link',
        'instagram_link',
        'twitter_link',
        'personal_link',
        'config_common',
    ];

    protected $casts = [
        'config_common' => 'json',
    ];
}
