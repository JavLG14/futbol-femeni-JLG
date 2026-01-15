<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Equip;
use Carbon\Carbon;

class PartitFactory extends Factory
{
    protected $model = \App\Models\Partit::class;

    public function definition()
    {
        // fechas aleatorias dentro de un año
        $date = $this->faker->dateTimeBetween('-1 year', '+1 year');

        return [
            'local_id' => Equip::factory(),
            'visitant_id' => Equip::factory(),
            'estadi_id' => \App\Models\Estadi::factory(),
            'arbitre_id' => \App\Models\User::factory()->state(['role' => 'arbitre']),
            'data' => $date,
            'jornada' => 1,
            'gols_local' => null,
            'gols_visitant' => null,
        ];
    }
}
