<?php

namespace Tests\Feature;

use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegionControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        //$this->artisan('db:seed', ['--class' => 'BulkSeeder']);
    }

    /** @test */
    public function it_can_store_a_new_region()
    {
        $response = $this->post('/api/regiones', [
            'nombre' => 'Test Region Stored',
            'ciudad_id' => 1
        ]);
        $response->assertStatus(201)
            ->assertJsonStructure([
                "id",
                "nombre",
                "updated_at",
                "created_at"
            ]);

        $responseData = $response->json();
        $storedRegion = Region::find($responseData['id']);

        $this->assertEquals('Test Region Stored', $storedRegion->nombre);
    }

    /** @test */
    public function it_can_show_a_region()
    {
        $region = Region::factory()->create();
        $response = $this->get("/api/regiones/{$region->id}");
        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_update_a_region()
    {
        $region = Region::factory()->create();

        $response = $this->put("/api/regiones/{$region->id}", [
            'nombre' => 'Test Edited 123',
            'ciudad_id' => $region->ciudad_id
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('regiones', [
            'id' => $region->id,
            'nombre' => 'Test Edited 123'
        ]);

        $updatedRegion = Region::find($region->id);

        $this->assertEquals('Test Edited 123', $updatedRegion->nombre);
    }

    /** @test */
    public function it_can_delete_a_region()
    {
        $region = Region::factory()->create();
        $response = $this->delete("/api/regiones/{$region->id}");
        $response->assertStatus(204);
    }
}
