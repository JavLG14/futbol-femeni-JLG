<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Models\Partit;
use App\Models\Equip;
use App\Models\Jugadora;
use App\Models\Estadi;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PolicyTest extends TestCase
{
    use RefreshDatabase;

    // --- PARTIT POLICY ---

    public function test_arbitre_can_update_assigned_partit()
    {
        $arbitre = User::factory()->create(['role' => 'arbitre']);
        $partit = Partit::factory()->create(['arbitre_id' => $arbitre->id]);

        $this->actingAs($arbitre);
        $this->assertTrue($arbitre->can('update', $partit));
    }

    public function test_arbitre_cannot_update_unassigned_partit()
    {
        $arbitre = User::factory()->create(['role' => 'arbitre']);
        $partit = Partit::factory()->create(['arbitre_id' => User::factory()->create(['role' => 'arbitre'])->id]);

        $this->actingAs($arbitre);
        $this->assertFalse($arbitre->can('update', $partit));
    }

    public function test_admin_cannot_update_partit()
    {
        $admin = User::factory()->create(['role' => 'administrador']);
        $partit = Partit::factory()->create();

        $this->actingAs($admin);
        $this->assertFalse($admin->can('update', $partit)); // As per recent change
    }

    // --- EQUIP POLICY ---

    public function test_manager_can_delete_own_team()
    {
        $equip = Equip::factory()->create();
        $manager = User::factory()->create(['role' => 'manager', 'equip_id' => $equip->id]);

        $this->actingAs($manager);
        $this->assertTrue($manager->can('delete', $equip));
    }

    public function test_manager_cannot_delete_other_team()
    {
        $equip = Equip::factory()->create();
        $otherEquip = Equip::factory()->create();
        $manager = User::factory()->create(['role' => 'manager', 'equip_id' => $otherEquip->id]);

        $this->actingAs($manager);
        $this->assertFalse($manager->can('delete', $equip));
    }

    // --- ESTADI POLICY ---

    public function test_admin_can_create_estadi()
    {
        $admin = User::factory()->create(['role' => 'administrador']);
        $this->actingAs($admin);
        $this->assertTrue($admin->can('create', Estadi::class));
    }

    public function test_manager_cannot_create_estadi()
    {
        $manager = User::factory()->create(['role' => 'manager']);
        $this->actingAs($manager);
        $this->assertFalse($manager->can('create', Estadi::class));
    }

    // --- JUGADORA POLICY ---

    public function test_manager_can_update_own_jugadora()
    {
        $equip = Equip::factory()->create();
        $jugadora = Jugadora::factory()->create(['equip_id' => $equip->id]);
        $manager = User::factory()->create(['role' => 'manager', 'equip_id' => $equip->id]);

        $this->actingAs($manager);
        $this->assertTrue($manager->can('update', $jugadora));
    }

    public function test_manager_cannot_update_other_jugadora()
    {
        $equip = Equip::factory()->create();
        $jugadora = Jugadora::factory()->create(['equip_id' => $equip->id]);
        $otherEquip = Equip::factory()->create();
        $manager = User::factory()->create(['role' => 'manager', 'equip_id' => $otherEquip->id]);

        $this->actingAs($manager);
        $this->assertFalse($manager->can('update', $jugadora));
    }

    public function test_manager_cannot_create_jugadora()
    {
        $manager = User::factory()->create(['role' => 'manager']);
        $this->actingAs($manager);
        $this->assertFalse($manager->can('create', Jugadora::class));
    }
}
