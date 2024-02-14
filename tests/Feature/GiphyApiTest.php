<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
use Tests\TestCase;

class GiphyApiTest extends TestCase
{
    use DatabaseTransactions;
    
    protected function createUserWithToken()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->accessToken;

        return $token;
    }

    public function testGetGifById(): void
    {
        
        $token = $this->createUserWithToken();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', '/api/gifs/tJU72w9lPzUPe');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data',
            'meta'
        ]);
    }
    
    public function testGetGifByIdMustFailIfIdDoesntExist(): void
    {
        
        $token = $this->createUserWithToken();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', '/api/gifs/aaa');
        
        $response->assertStatus(401);
    }

    

    public function testGetGifsMustResturnTwoRegisters(): void
    {
        $token = $this->createUserWithToken();

        $data = [
            'q' => 'guitar',
            'limit' => '2',
        ];

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->json('GET', '/api/gifs/', $data);

        $response->assertStatus(200);
        $response->assertJsonPath('pagination.count', 2);
    }

    public function testPostBookmark(): void
    {
        $requestData = [
            'gif_id' => 'ihwf3TcW5d3k5ascQ4',
            'alias' => 'test',
        ];

        $token = $this->createUserWithToken();
        
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ])->post('/api/gifs/bookmarks/', $requestData);

        $this->assertDatabaseHas('bookmarks', [
            'gif_id' => 'ihwf3TcW5d3k5ascQ4',
            'alias' => 'test',
        ]);
        $response->assertStatus(201);
    }
}
