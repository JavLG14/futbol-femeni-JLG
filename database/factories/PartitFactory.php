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
            'local_id' => Equip::inRandomOrder()->first()->id,
            'visitant_id' => Equip::inRandomOrder()->whereNot('id', '!=', null)->first()->id, // luego se filtra en el seeder
            'estadi_id' => \App\Models\Estadi::inRandomOrder()->first()->id,
            'data' => $date,
            'jornada' => 1,
            'gols' => null, // se puede generar más adelante si la fecha ya pasó
        ];
    }
}
