<?php

namespace Tests\Feature;

use App\Models\Calle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CalleControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'BulkSeeder']);
    }

    /** @test */
    public function it_can_list_as_pages()
    {
        $response = $this->get('/api/calles');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'meta' => [
                    'total',
                    'per_page',
                    'current_page',
                    'last_page',
                    'path',
                    'from',
                    'to',
                ],
                'links' => [
                    'first',
                    'last',
                    'next',
                    'prev',
                ],
                'data',
            ]);
    }

    /** @test */
    public function it_can_store_a_new_calle()
    {
        $response = $this->post('/api/calles', [
            'nombre' => 'Test Calle Stored',
            'ciudad_id' => 1
        ]);
        $response->assertStatus(201)
            ->assertJsonStructure([
                "id",
                "nombre",
                "ciudad_id",
                "updated_at",
                "created_at"
            ]);

        $responseData = $response->json();
        $storedCalle = Calle::find($responseData['id']);

        $this->assertEquals('Test Calle Stored', $storedCalle->nombre);
    }

    /** @test */
    public function it_can_show_a_calle()
    {
        $calle = Calle::factory()->create();
        $response = $this->get("/api/calles/{$calle->id}");
        $response->assertStatus(200);
    }

    /** @test */
    public function it_can_update_a_calle()
    {
        $calle = Calle::factory()->create();

        $response = $this->put("/api/calles/{$calle->id}", [
            'nombre' => 'Test Edited 123',
            'ciudad_id' => $calle->ciudad_id
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('calles', [
            'id' => $calle->id,
            'nombre' => 'Test Edited 123'
        ]);

        $updatedCalle = Calle::find($calle->id);

        $this->assertEquals('Test Edited 123', $updatedCalle->nombre);
    }

    /** @test */
    public function it_can_delete_a_calle()
    {
        $calle = Calle::factory()->create();
        $response = $this->delete("/api/calles/{$calle->id}");
        $response->assertStatus(204);
    }
}
