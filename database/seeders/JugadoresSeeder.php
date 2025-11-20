<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jugadora;
use App\Models\Equip;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Carbon\Carbon;

class JugadoresSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $equips = Equip::all();

        if ($equips->isEmpty()) {
            $this->command->error("Primero debes crear los equipos.");
            return;
        }

        foreach ($equips as $equip) {
            // Generar entre 11 y 20 jugadoras por equipo
            $numJugadoras = rand(11, 20);

            for ($i = 0; $i < $numJugadoras; $i++) {
                // Fecha de nacimiento mínima 16 años
                $fechaNacimiento = $faker->dateTimeBetween('-40 years', '-16 years');

                Jugadora::create([
                    'nom' => $faker->unique()->name,
                    'equip_id' => $equip->id,
                    'data_naixement' => Carbon::parse($fechaNacimiento)->format('Y-m-d'),
                    'dorsal' => rand(1, 99),
                    'foto' => 'jugadora' . Str::random(5) . '.png', // nombre de archivo ejemplo
                ]);
            }
        }

        $this->command->info("Jugadoras generadas correctamente.");
    }
}
