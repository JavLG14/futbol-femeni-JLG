<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UpdatePartitRequest;
use App\Http\Requests\StoreJugadoraRequest;
use App\Models\Equip;
use App\Models\Estadi;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RequestTest extends TestCase
{
    use RefreshDatabase;

    public function test_update_partit_request_validation()
    {
        $local = Equip::factory()->create();
        $visitant = Equip::factory()->create();
        $estadi = Estadi::factory()->create();

        $request = new UpdatePartitRequest();
        $rules = $request->rules();

        $data = [
            'local_id' => $local->id,
            'visitant_id' => $visitant->id,
            'estadi_id' => $estadi->id,
            'data' => '2026-01-01',
            'jornada' => 1,
            'gols_local' => 2,
            'gols_visitant' => 1
        ];

        $validator = Validator::make($data, $rules);
        $this->assertTrue($validator->passes());

        // Test Invalid: Same Team
        $badData = $data;
        $badData['visitant_id'] = $local->id;
        $validator = Validator::make($badData, $rules);
        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('visitant_id', $validator->errors()->toArray());
    }

    public function test_store_jugadora_request_validation()
    {
        $equip = Equip::factory()->create();

        $request = new StoreJugadoraRequest();
        $rules = $request->rules();

        $data = [
            'nom' => 'Jugadora',
            'dorsal' => 10,
            'equip_id' => $equip->id,
            'data_naixement' => now()->subYears(20)->format('Y-m-d'), // 20 years old
        ];

        $validator = Validator::make($data, $rules);
        $this->assertTrue($validator->passes());

        // Test Invalid: Too Young (e.g., 5 years old)
        $badData = $data;
        $badData['data_naixement'] = now()->subYears(5)->format('Y-m-d');
        $validator = Validator::make($badData, $rules);
        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('data_naixement', $validator->errors()->toArray());
    }
}
