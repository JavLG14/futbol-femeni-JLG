<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\EstadiService;
use App\Models\Estadi;
use App\Repositories\EstadiRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EstadiServiceTest extends TestCase
{
    use RefreshDatabase;

    private $service;

    protected function setUp(): void
    {
        parent::setUp();
        // Since we are using RefreshDatabase, we can use the real implementation
        $this->service = new EstadiService(new EstadiRepository());
    }

    public function test_can_create_estadi()
    {
        $data = ['nom' => 'Nou Estadi Test', 'capacitat' => 5000];
        $estadi = $this->service->guardar($data);

        $this->assertInstanceOf(Estadi::class, $estadi);
        $this->assertDatabaseHas('estadis', ['nom' => 'Nou Estadi Test']);
    }

    public function test_can_update_estadi()
    {
        $estadi = Estadi::factory()->create(['nom' => 'Old Name']);
        $updated = $this->service->actualitzar($estadi->id, ['nom' => 'New Name']);

        $this->assertEquals('New Name', $updated->nom);
        $this->assertDatabaseHas('estadis', ['id' => $estadi->id, 'nom' => 'New Name']);
    }

    public function test_can_delete_estadi()
    {
        $estadi = Estadi::factory()->create();
        $this->service->eliminar($estadi->id);

        $this->assertDatabaseMissing('estadis', ['id' => $estadi->id]);
    }
}
