<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition (): array
    {
        return [
            "title" => $this->faker->title (),
            "description" => $this->faker->text (),
            "image" => $this->faker->imageUrl (),
            "slug" => $this->faker->slug (),
            "image_logo" => $this->faker->imageUrl (),
            "title_logo" => $this->faker->name(),
        ];
    }
}
