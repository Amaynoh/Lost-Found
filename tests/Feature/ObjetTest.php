<?php

namespace Tests\Feature;

use App\Models\Objets;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ObjetTest extends TestCase
{
    use RefreshDatabase; 

     /** @test */
    public function index()
    {
        Objets::factory()->count(2)->create();

        $response = $this->getJson('/api/objets');

        $response->assertStatus(200)
                 ->assertJsonCount(2);
    }
    /** @test */
    public function filter()
    {
        Objets::factory()->create(['type' => 'perdu']);
        Objets::factory()->create(['type' => 'trouve']);

        $response = $this->getJson('/api/objets/filter?type=perdu');

        $response->assertStatus(200)
                 ->assertJsonCount(1);
    }
       
    /** @test */
    public function update()
    {
        $user = User::factory()->create();
        $objet = Objets::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user, 'sanctum')->putJson("/api/objets/{$objet->id}", ['title' => 'Titre modifié']);

        $response->assertStatus(200);

        $this->assertDatabaseHas('objets', [
            'id' => $objet->id,
            'title' => 'Titre modifié'
        ]);
    }
        /** @test */
    public function store()
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $data = [
            'title' => 'Téléphone',
            'description' => 'Téléphone perdu',
            'type' => 'perdu',
            'location' => 'Casablanca',
            'date' => '2026-01-21',
            'image' => UploadedFile::fake()->image('test.jpg'),
        ];

        $response = $this->actingAs($user, 'sanctum')
                         ->postJson('/api/objets', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('objets', [
            'title' => 'Téléphone'
        ]);
    }
    /** @test */
    public function admin_can_delete()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $objet = Objets::factory()->create();

        $response = $this->actingAs($admin, 'sanctum')
                         ->deleteJson("/api/objets/{$objet->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('objets', [
            'id' => $objet->id
        ]);
    }

}
