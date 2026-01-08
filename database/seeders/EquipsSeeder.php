<?php

namespace Database\Seeders;

use App\Models\Equip;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class EquipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Equip::factory()->count(18)->create();
        foreach (Equip::all() as $equip){
            User::create([
                'name' => 'Manager  '.$equip->nom,
                'email' => $equip->id.'@manager.com',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'equip_id' => $equip->id,
            ]);
        }
    }
}