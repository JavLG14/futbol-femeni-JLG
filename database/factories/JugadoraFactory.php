<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Equip;

class JugadoraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->firstName(),
            'equip_id' => Equip::factory(),
            'data_naixement' => $this->faker->date(),
            'dorsal' => $this->faker->numberBetween(1, 99),
            // foto is nullable usually or can be a placeholder
        ];
    }
}
