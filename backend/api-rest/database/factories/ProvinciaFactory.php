<?php

namespace Database\Factories;

use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Provincia>
 */
class ProvinciaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $regionIds = Region::pluck('id')->toArray();
        $id = $this->faker->numberBetween(10001, 99999);

        return [
            'id' => $id,
            'nombre' => $this->faker->streetName,
            'region_id' => $this->faker->randomElement($regionIds),
        ];
    }
}
