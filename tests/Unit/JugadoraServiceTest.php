<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\JugadoraService;
use App\Models\Jugadora;
use App\Models\Equip;
use App\Repositories\JugadoraRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JugadoraServiceTest extends TestCase
{
    use RefreshDatabase;

    private $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new JugadoraService(new JugadoraRepository());
    }

    public function test_can_create_jugadora()
    {
        $equip = Equip::factory()->create();
        $data = [
            'nom' => 'Jugadora Test',
            'cognoms' => 'Cognoms Test',
            'equip_id' => $equip->id,
            'data_naixement' => '2000-01-01',
            'dorsal' => 10,
            // Add other required fields if any (based on migration/model)
        ];

        $jugadora = $this->service->createJugadora($data);

        $this->assertInstanceOf(Jugadora::class, $jugadora);
        $this->assertDatabaseHas('jugadores', ['nom' => 'Jugadora Test']);
    }

    public function test_can_update_jugadora()
    {
        $jugadora = Jugadora::factory()->create(['nom' => 'Old Name']);
        $updated = $this->service->updateJugadora($jugadora->id, ['nom' => 'New Name']);

        $this->assertEquals('New Name', $updated->nom);
        $this->assertDatabaseHas('jugadores', ['id' => $jugadora->id, 'nom' => 'New Name']);
    }

    public function test_can_delete_jugadora()
    {
        $jugadora = Jugadora::factory()->create();
        $this->service->deleteJugadora($jugadora->id);

        $this->assertDatabaseMissing('jugadores', ['id' => $jugadora->id]);
    }
}
