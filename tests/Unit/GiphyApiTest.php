<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Http\Controllers\GiphyApiController;
use Illuminate\Http\Request;
use Mockery;


class GiphyApiTest extends TestCase
{

    protected $giphyServiceMock;

    protected function setUp(): void
    {
        parent::setUp();

        // Crear un mock del servicio Giphy
        $this->giphyServiceMock = Mockery::mock('App\Services\GiphyService');
    }

    protected function tearDown(): void
    {
        
        parent::tearDown();

        // Cerrar el mock después de cada prueba
        Mockery::close();
    }
    /**
     * A basic unit test example.
     */
    public function testSearchGifsWithValidToken(): void
    {
        
    }
}
