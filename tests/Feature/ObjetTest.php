<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ObjetTest extends TestCase
{
    use RefreshDatabase; 

    public function test_user_can_get_objets_list()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/api/objets');
        $response->assertStatus(200);
    }
}
