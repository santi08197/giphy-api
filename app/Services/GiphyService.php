<?php

namespace App\Services;

use GuzzleHttp\Client;

class GiphyService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = getenv('GIPHY_API_KEY');
    }

    public function searchGifs($query, $limit, $offset)
    {
        $client = new Client();
        
        $query = [
            'api_key' => $this->apiKey,
            'q'  => $query,
            'offset' => $limit,
        ];

        if($limit){
            $query['limit'] =  $limit;
        }
        $response = $client->get("https://api.giphy.com/v1/gifs/search", [
            'query' => $query,
        ]);

        return json_decode($response->getBody(), true);
    }

    public function getGifById($gifId)
    {
        $client = new Client();
        $response = $client->get("https://api.giphy.com/v1/gifs/".$gifId, [
            'query' => [
                'api_key' => $this->apiKey,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
