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

    public function test(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Test Server',
                'ip_address' => '162.252.173.13',
                'username' => 'root',
                'status' => 'active',
                'private_key' => '-----BEGIN OPENSSH PRIVATE KEY-----
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
-----END OPENSSH PRIVATE KEY-----',
            ];
        });
    }
}
