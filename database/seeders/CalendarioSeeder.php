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

        if ($equips->count() < 18 || $equips->count() % 2 != 0) {
            $this->command->error("Se necesitan 18 equipos (o un número par) para generar el calendario correctamente.");
            return;
        }

        $teamIds = $equips->pluck('id')->toArray();
        $numTeams = count($teamIds);
        $totalRounds = $numTeams - 1;

        // Start date: Last Sunday of August 2025
        $startDate = Carbon::create(2025, 8, 24)->startOfDay();

        // ---------------------------------
        // GENERATE ROUNDS
        // ---------------------------------
        $rounds = [];
        for ($i = 0; $i < $totalRounds; $i++) {
            $roundMatches = [];
            for ($j = 0; $j < $numTeams / 2; $j++) {
                $home = $teamIds[$j];
                $away = $teamIds[$numTeams - 1 - $j];

                if ($i % 2 == 0) {
                    $roundMatches[] = ['local' => $home, 'visitant' => $away];
                } else {
                    $roundMatches[] = ['local' => $away, 'visitant' => $home];
                }
            }
            $rounds[] = $roundMatches;

            $last = array_pop($teamIds);
            array_splice($teamIds, 1, 0, $last);
        }

        // ---------------------------------
        // CREATE MATCHES
        // ---------------------------------

        foreach ($rounds as $roundIndex => $matches) {
            $jornada = $roundIndex + 1;
            $matchDate = $startDate->copy()->addWeeks($roundIndex);

            foreach ($matches as $match) {
                $finalDate = $matchDate->copy()->subDays(rand(0, 1))->setTime(rand(16, 21), 0);

                $played = $finalDate->isPast();

                $localId = $match['local'];
                $visitantId = $match['visitant'];
                // Get stadium of local team
                $localTeam = $equips->firstWhere('id', $localId);

                Partit::create([
                    'local_id' => $localId,
                    'visitant_id' => $visitantId,
                    'estadi_id' => $localTeam->estadi_id,
                    'data' => $finalDate,
                    'jornada' => $jornada,
                    'gols_local' => $played ? rand(0, 5) : null,
                    'gols_visitant' => $played ? rand(0, 5) : null,
                    'arbitre_id' => $arbitres->random()->id,
                ]);
            }
        }

        // Vueltas
        $secondLegStartDate = $startDate->copy()->addWeeks($totalRounds);

        foreach ($rounds as $roundIndex => $matches) {
            $jornada = $totalRounds + $roundIndex + 1;
            $matchDate = $secondLegStartDate->copy()->addWeeks($roundIndex);

            foreach ($matches as $match) {
                $finalDate = $matchDate->copy()->subDays(rand(0, 1))->setTime(rand(16, 21), 0);
                $played = $finalDate->isPast();

                // Swap Home/Away
                $localId = $match['visitant'];
                $visitantId = $match['local'];
                $localTeam = $equips->firstWhere('id', $localId);

                Partit::create([
                    'local_id' => $localId,
                    'visitant_id' => $visitantId,
                    'estadi_id' => $localTeam->estadi_id,
                    'data' => $finalDate,
                    'jornada' => $jornada,
                    'gols_local' => $played ? rand(0, 5) : null,
                    'gols_visitant' => $played ? rand(0, 5) : null,
                    'arbitre_id' => $arbitres->random()->id,
                ]);
            }
        }

        $this->command->info("Calendario generado correctamente: " . ($totalRounds * 2) . " jornadas.");
    }
}
