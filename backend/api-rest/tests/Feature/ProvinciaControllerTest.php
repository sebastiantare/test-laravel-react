<?php

namespace Tests\Feature;

use App\Models\Provincia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProvinciaControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'BulkSeeder']);
    }

    /** @test */
    public function it_can_store_a_new_provincia()
    {
        $response = $this->post('/api/provincias', [
            'nombre' => 'Test Provincia Stored',
            'region_id' => 1 //Arica y parinacota
        ]);
        $response->assertStatus(201)
            ->assertJsonStructure([]);

        $responseData = $response->json();
        $storedProvincia = Provincia::find($responseData['id']);

        $this->assertEquals('Test Provincia Stored', $storedProvincia->nombre);
    }

    /** @test */
    public function it_can_show_a_provincia()
    {
        $provincia = Provincia::factory()->create();
        $response = $this->get("/api/provincias/{$provincia->id}");
        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_update_a_provincia()
    {
        $provincia = Provincia::factory()->create();

        $response = $this->put("/api/provincias/{$provincia->id}", [
            'nombre' => 'Test Edited 123',
            'region_id' => $provincia->region_id
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('provincias', [
            'id' => $provincia->id,
            'nombre' => 'Test Edited 123'
        ]);

        $updatedProvincia = Provincia::find($provincia->id);

        $this->assertEquals('Test Edited 123', $updatedProvincia->nombre);
    }

    /** @test */
    public function it_can_delete_a_provincia()
    {
        $provincia = Provincia::factory()->create();
        $response = $this->delete("/api/provincias/{$provincia->id}");
        $response->assertStatus(204);
    }
}
