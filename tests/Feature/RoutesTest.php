<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Partit;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoutesTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_routes_are_accessible()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/equips');
        $response->assertStatus(200);

        $response = $this->get('/jugadores');
        $response->assertStatus(200);

        $response = $this->get('/partits');
        $response->assertStatus(200);

        $response = $this->get('/estadis');
        $response->assertStatus(200);
    }

    public function test_protected_routes_redirect_guests()
    {
        $partit = Partit::factory()->create();
        $response = $this->get("/partits/{$partit->id}/edit");
        $response->assertRedirect('/login');
    }

    public function test_arbitre_can_access_edit_route_for_assigned_match()
    {
        $arbitre = User::factory()->create(['role' => 'arbitre']);
        $partit = Partit::factory()->create(['arbitre_id' => $arbitre->id]);

        $response = $this->actingAs($arbitre)->get("/partits/{$partit->id}/edit");
        $response->assertStatus(200);
    }

    public function test_unauthorized_user_cannot_access_edit_route()
    {
        $user = User::factory()->create(['role' => 'user']); // Standard user
        $partit = Partit::factory()->create();

        $response = $this->actingAs($user)->get("/partits/{$partit->id}/edit");
        $response->assertStatus(403);
    }
}
