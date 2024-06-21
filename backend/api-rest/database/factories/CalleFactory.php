<?php

namespace Database\Factories;

use App\Models\Ciudad;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Calle>
 */
class CalleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $ciudadIds = Ciudad::pluck('id')->toArray();

        return [
            'nombre' => $this->faker->streetName,
            'ciudad_id' => $this->faker->randomElement($ciudadIds),
        ];
    }
}
