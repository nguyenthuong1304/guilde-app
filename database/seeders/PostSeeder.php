<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        DB::table('posts')->truncate();

        $categories = Category::factory()
            ->count(10)
            ->create();

        $categories->each(function ($cate) {
            Post::factory()->create([
                'category_id' => $cate->id,
                'image' => null,
                'published' => true,
                'views' => 50,
                'published_at' => now(),
                'next_id'=> null,
                'prev_id'=> null,
            ]);
        });
    }
}
