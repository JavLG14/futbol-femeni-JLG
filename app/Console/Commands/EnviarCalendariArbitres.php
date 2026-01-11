<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\User;
use App\Models\Partit;
use Illuminate\Support\Facades\Mail;
use App\Mail\JornadaArbitresMail;

class EnviarCalendariArbitres extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jornada:enviar-arbitres';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia un correu a cada àrbitre amb el seu calendari de partits assignats.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $arbitres = User::where('role', 'arbitre')->get();
        $count = 0;

        $this->info("Iniciant enviament de calendaris a {$arbitres->count()} àrbitres...");

        foreach ($arbitres as $arbitre) {
            $partits = Partit::where('arbitre_id', $arbitre->id)
                ->with(['local', 'visitant', 'estadi'])
                ->orderBy('data')
                ->get();

            if ($partits->count() > 0) {
                Mail::to($arbitre->email)->send(new JornadaArbitresMail($arbitre, $partits));
                $count++;
            }
        }

        $this->info("S'han enviat {$count} calendaris correctament.");
    }
}
