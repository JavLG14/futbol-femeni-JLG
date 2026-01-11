<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\PartitService;
use App\Models\Partit;
use App\Models\Equip;
use App\Models\Estadi;
use App\Models\User;
use App\Repositories\PartitRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;

class PartitServiceTest extends TestCase
{
    use RefreshDatabase;

    private $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new PartitService(new PartitRepository());
    }

    public function test_can_create_partit()
    {
        $local = Equip::factory()->create();
        $visitant = Equip::factory()->create();
        // Create estadi with no constraints if possible, or just create one
        $estadi = Estadi::factory()->create();
        $arbitre = User::factory()->create(['role' => 'arbitre']);

        $data = [
            'local_id' => $local->id,
            'visitant_id' => $visitant->id,
            'estadi_id' => $estadi->id,
            'arbitre_id' => $arbitre->id,
            'data' => Carbon::now()->addDay(),
            'jornada' => 1,
            'gols_local' => null,
            'gols_visitant' => null
        ];

        $partit = $this->service->create($data);

        $this->assertInstanceOf(Partit::class, $partit);
        $this->assertDatabaseHas('partits', ['local_id' => $local->id]);
    }

    public function test_can_update_partit_result()
    {
        $partit = Partit::factory()->create(['gols_local' => null, 'gols_visitant' => null]);

        $updated = $this->service->update($partit->id, [
            'gols_local' => 2,
            'gols_visitant' => 1
        ]);

        $this->assertEquals(2, $updated->gols_local);
        $this->assertDatabaseHas('partits', ['id' => $partit->id, 'gols_local' => 2]);
    }

    public function test_can_delete_partit()
    {
        $partit = Partit::factory()->create();
        $this->service->delete($partit->id);

        $this->assertDatabaseMissing('partits', ['id' => $partit->id]);
    }

    public function test_can_get_equips_for_select()
    {
        Equip::factory()->create(['nom' => 'Beta']);
        Equip::factory()->create(['nom' => 'Alpha']);

        $equips = $this->service->getEquips();

        $this->assertGreaterThanOrEqual(2, $equips->count());
        $this->assertEquals('Alpha', $equips->first()->nom); // Check ordering
    }

    public function test_can_get_estadis_for_select()
    {
        Estadi::factory()->create(['nom' => 'Zeta Stadium']);
        Estadi::factory()->create(['nom' => 'Arena A']);

        $estadis = $this->service->getEstadis();

        $this->assertGreaterThanOrEqual(2, $estadis->count());
        $this->assertEquals('Arena A', $estadis->first()->nom); // Check ordering
    }
}
