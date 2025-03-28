<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VpsServer>
 */
class VpsServerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'ip_address' => $this->faker->ipv4,
            'username' => $this->faker->userName,
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'private_key' => $this->faker->text,
        ];
    }
}
