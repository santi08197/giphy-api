<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
use Tests\TestCase;

class GiphyApiTest extends TestCase
{
    use DatabaseTransactions;
    
    public function testGetGifById(): void
    {
        
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->accessToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', '/api/gif/tJU72w9lPzUPe');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data',
            'meta'
        ]);
    }
    
    public function testGetGifByIdMustFailIfIdDoesntExist(): void
    {
        
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->accessToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', '/api/gif/aaa');
        
        $response->assertStatus(401);
    }

    

    public function testGetGifsMustResturnTwoRegisters(): void
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->accessToken;

        $data = [
            'q' => 'guitar',
            'limit' => '3',
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->json('GET', '/api/gif/', $data);

        $response->assertStatus(200);
        $response->assertJsonPath('pagination.count', 3);
    }

    public function testPostBookmark(): void
    {
        $requestData = [
            'gif_id' => 'tJU72w9lPzUPe',
            'alias' => 'guitar_gif_test',
            'user_id' => 11,
        ];

        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->accessToken;
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->post('/api/gif/bookmark/', $requestData);

        $this->assertDatabaseHas('bookmarks', [
            'gif_id' => 'tJU72w9lPzUPe',
            'alias' => 'guitar_gif_test',
            'user_id' => 11,
        ]);
        $response->assertStatus(201);
}
}
