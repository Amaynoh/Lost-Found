<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function un_utilisateur_peut_s_inscrire()
    {
        $data = [
            'name'     => 'Amina',
            'email'    => 'amina@test.com',
            'password' => 'password123'
        ];

        $response = $this->postJson('/api/register', $data);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'message',
                     'token',
                     'user' => [
                         'id',
                         'name',
                         'email',
                         'role'
                     ]
                 ]);

        $this->assertDatabaseHas('users', [
            'email' => 'amina@test.com'
        ]);
    }
        /** @test */
    public function un_utilisateur_peut_se_connecter()
    {
        $user = User::create([
            'name' => 'Amina',
            'email' => 'amina@test.com',
            'password' => Hash::make('password123'),
            'role' => 'user'
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'amina@test.com',
            'password' => 'password123'
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'token',
                     'user'
                 ]);
    }
    /** @test */
    public function un_utilisateur_peut_se_deconnecter()
    {
        $user = User::create([
            'name' => 'Amina',
            'email' => 'amina@test.com',
            'password' => Hash::make('password123'),
            'role' => 'user'
        ]);

        $token = $user->createToken('token')->plainTextToken;

        $response = $this->withHeader('Authorization', 'Bearer ' . $token)
                         ->postJson('/api/logout');

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Déconnexion réussie'
                 ]);
    }
}
