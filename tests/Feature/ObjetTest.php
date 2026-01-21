<?php

namespace Tests\Feature;

use App\Models\Objets;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use GuzzleHttp\Psr7\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ObjetTest extends TestCase
{
    use RefreshDatabase; 

     /** @test */
    public function user_can_get_objets_list()
    {
        Objets::factory()->count(2)->create();

        $response = $this->getJson('/api/objets');

        $response->assertStatus(200)
                 ->assertJsonCount(2);
    }
    /** @test */
    public function user_can_filter_objets_by_type()
    {
        Objets::factory()->create(['type' => 'perdu']);
        Objets::factory()->create(['type' => 'trouve']);

        $response = $this->getJson('/api/objets/filter?type=perdu');

        $response->assertStatus(200)
                 ->assertJsonCount(1);
    }
       
    /** @test */
    public function owner_can_update_his_objet()
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
}
