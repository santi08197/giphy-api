<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker; 
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use DatabaseTransactions, WithFaker;

    public function test_login_with_valid_credentials()
    {
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => Hash::make('123'), 
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => '123',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['token', 'expires_in']);
        
        $token = $response->json('token');
        $this->assertNotEmpty($token);
    }

    public function test_login_with_invalid_credentials()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'invalid@example.com',
            'password' => 'invalidpassword',
        ]);

        $response->assertStatus(400)
            ->assertJson(['message' => 'Email and/or invalid.']);
    }
}