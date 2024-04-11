<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Team;
use App\Models\Post;
use Database\Factories\TeamFactory;

use function DI\add;
use function DI\factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Post::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'tags' => 'laravel,php,testing,unit,feature,workshop,laracasts',
            'created_at' => now(),
            "publish_date" => now()->addDays(rand(1, 30)),
        ];
    }
}
