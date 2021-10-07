<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => null,
            'name' => $this->faker->name(),
            'slug' => Str::slug($this->faker->name()),
            'description' => $this->faker->word(),
            'content' => $this->faker->word(),
            'image' => null,
            'published' => true,
            'views' => 50,
            'published_at' => now(),
            'next_id'=> null,
            'prev_id'=> null,
        ];
    }
}
