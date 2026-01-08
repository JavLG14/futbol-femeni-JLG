<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'administrador',
        ]);

        User::create([
            'name' => 'Arbitre Principal',
            'email' => 'arbitre@example.com',
            'password' => Hash::make('password'),
            'role' => 'arbitre',
        ]);

        // Create a pool of referees
        User::factory(10)->create([
            'password' => Hash::make('password'),
            'role' => 'arbitre',
        ]);
    }
}