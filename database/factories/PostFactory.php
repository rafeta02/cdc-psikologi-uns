<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = \App\Models\Post::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'slug' => Str::slug($this->faker->sentence),
            'content' => $this->faker->paragraphs(3, true),
            'excerpt' => $this->faker->text(200),
            'meta_title' => $this->faker->sentence,
            'meta_description' => $this->faker->text(160),
            'status' => $this->faker->randomElement(['draft', 'published']),
            'author_id' => 1,
            'created_by_id' => 1,
        ];
    }
}
