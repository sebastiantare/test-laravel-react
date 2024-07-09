<?php

namespace Database\Factories;

use App\Models\Provincia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ciudad>
 */
class CiudadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $provinciaIds = Provincia::pluck('id')->toArray();
        $id = $this->faker->numberBetween(10001, 99999);

        return [
            'id' => $id,
            'nombre' => $this->faker->streetName,
            'provincia_id' => $this->faker->randomElement($provinciaIds),
        ];
    }
}
