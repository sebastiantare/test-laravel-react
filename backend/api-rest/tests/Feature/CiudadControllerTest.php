<?php

namespace Tests\Feature;

use App\Models\Ciudad;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CiudadControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'BulkSeeder']);
    }

    /** @test */
    public function it_can_store_a_new_ciudad()
    {
        $response = $this->post('/api/ciudades', [
            'nombre' => 'Test Ciudad Stored',
            'provincia_id' => 1 //Arica
        ]);
        $response->assertStatus(201)
            ->assertJsonStructure([

            ]);

        $responseData = $response->json();
        $storedCiudad = Ciudad::find($responseData['id']);

        $this->assertEquals('Test Ciudad Stored', $storedCiudad->nombre);
    }

    /** @test */
    public function it_can_show_a_ciudad()
    {
        $ciudad = Ciudad::factory()->create();
        $response = $this->get("/api/ciudades/{$ciudad->id}");
        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_update_a_ciudad()
    {
        $ciudad = Ciudad::factory()->create();

        $response = $this->put("/api/ciudades/{$ciudad->id}", [
            'nombre' => 'Test Edited 123',
            'ciudad_id' => $ciudad->ciudad_id
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('ciudades', [
            'id' => $ciudad->id,
            'nombre' => 'Test Edited 123'
        ]);

        $updatedCiudad = Ciudad::find($ciudad->id);

        $this->assertEquals('Test Edited 123', $updatedCiudad->nombre);
    }

    /** @test */
    public function it_can_delete_a_ciudad()
    {
        $ciudad = Ciudad::factory()->create();
        $response = $this->delete("/api/ciudades/{$ciudad->id}");
        $response->assertStatus(204);
    }
}
