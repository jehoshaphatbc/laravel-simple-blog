<?php

namespace Database\Factories;

use App\Enums\StatusPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition(): array
    {
        return [
            'title' => Str::limit($this->faker->sentence, 60),
            'content' => $this->faker->paragraph,
            'user_id' => User::all()->random()->id,
            'publish_date' => $this->faker->optional()->dateTimeThisYear(),
            'status' => $this->faker->randomElement([
                StatusPost::DRAFT->value,
                StatusPost::PUBLISHED->value,
                StatusPost::SCHEDULE->value,
            ]),
        ];
    }
}
