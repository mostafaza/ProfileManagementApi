<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'pro_first_name' => fake()->name(),
            'pro_last_name' => fake()->name(),
            'pro_image_path' => UploadedFile::fake()->image('image.jpg'),
            'pro_status' => $this->faker->randomElement(['inactive', 'pending', 'active']),
        ];
    }
}
