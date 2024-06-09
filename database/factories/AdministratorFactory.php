<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AdministratorFactory extends Factory
{
      /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'adm_name' => fake()->name(),
            'adm_email' => fake()->unique()->safeEmail(),
            'adm_password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    
}
