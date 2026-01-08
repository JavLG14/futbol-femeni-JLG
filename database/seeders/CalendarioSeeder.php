<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equip;
use App\Models\Partit;
use Carbon\Carbon;
use Faker\Factory as Faker;

class CalendarioSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $equips = Equip::all();
        $arbitres = \App\Models\User::where('role', 'arbitre')->get();

        if ($arbitres->isEmpty()) {
            $this->command->error("No hay árbitros disponibles. Ejecuta el UserSeeder primero.");
            return;
        }

        if ($equips->count() < 18) {
            $this->command->error("Se necesitan 18 equipos para generar el calendario.");
            return;
        }

        $jornada = 1;

        foreach ($equips as $local) {
            foreach ($equips as $visitant) {

                // Evitar partido contra sí mismo
                if ($local->id === $visitant->id)
                    continue;

                // ---------------------------------
                // PARTIDO DE IDA
                // ---------------------------------

                $fechaIda = Carbon::parse(
                    $faker->dateTimeBetween('-2 months', '+3 months')
                );

                // si la fecha ya pasó → goles aleatorios
                $gLocalIda = $fechaIda->isPast() ? rand(0, 5) : null;
                $gVisitantIda = $fechaIda->isPast() ? rand(0, 5) : null;

                Partit::create([
                    'local_id' => $local->id,
                    'visitant_id' => $visitant->id,
                    'estadi_id' => $local->estadi_id, // el local juega en casa
                    'data' => $fechaIda,
                    'jornada' => $jornada,
                    'gols_local' => $gLocalIda,
                    'gols_visitant' => $gVisitantIda,
                    'arbitre_id' => $arbitres->random()->id,
                ]);

                // ---------------------------------
                // PARTIDO DE VUELTA
                // ---------------------------------

                $fechaVuelta = Carbon::parse(
                    $faker->dateTimeBetween('-2 months', '+3 months')
                );

                $gLocalVuelta = $fechaVuelta->isPast() ? rand(0, 5) : null;
                $gVisitantVuelta = $fechaVuelta->isPast() ? rand(0, 5) : null;

                Partit::create([
                    'local_id' => $visitant->id,
                    'visitant_id' => $local->id,
                    'estadi_id' => $visitant->estadi_id,
                    'data' => $fechaVuelta,
                    'jornada' => $jornada,
                    'gols_local' => $gLocalVuelta,
                    'gols_visitant' => $gVisitantVuelta,
                    'arbitre_id' => $arbitres->random()->id,
                ]);

                $jornada++;
            }
        }

        $this->command->info("Calendario generado correctamente (anada + tornada).");
    }
}
