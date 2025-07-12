<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nasabah>
 */
class NasabahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->name(),
            'telepon' => $this->faker->phoneNumber(),
            'alamat' => $this->faker->address(),
            'foto' => null,
            'email' => $this->faker->unique()->safeEmail(),
            'peran' => 'Nasabah',
            'password' => bcrypt('password'), // atau hash default
            'is_status' => true,
            'remember_token' => Str::random(10),
        ];
    }
}
