<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GiphyService;
use Illuminate\Support\Facades\Auth;
use App\Models\Bookmark;
use App\Http\Controllers\RequestLogController;

class GiphyApiController extends Controller
{
    protected $giphyService;

    public function __construct(GiphyService $giphyService)
    {
        $this->giphyService = $giphyService;
    }

    public function searchGifs(Request $request)
    {
        $validated = $request->validate([
            'q' => 'required|string',
            'limit' => 'integer',
            'offset' => 'integer',
        ]);
        
        try {
            $limit = isset($validated['limit']) ? $validated['limit'] : null;
            $offset = isset($validated['offset']) ? $validated['offset'] : 0;
            
            $gifs = $this->giphyService->searchGifs($validated['q'], $limit, $offset);
            
            $response = response()->json($gifs);
        } catch (\Exception $e) {
            $response = response()->json(['error' => $e->getMessage()], 401);
        }

        RequestLogController::saveRequestLog($request, $response, 'Search Gifs');
        return $response;
    }

    public function getGifById(Request $request, $gifId)
    {
        try {
            $gif = $this->giphyService->getGifById($gifId);

            $response = response()->json($gif);
        } catch (\Exception $e) {
            $response = response()->json(['error' => $e->getMessage()], 401);
        }
        
        RequestLogController::saveRequestLog($request, $response, 'Get Gif by ID');

        return $response;
    }

    
    public function bookmarkGif(Request $request)
    {
        $validated = $request->validate([
            'gif_id' => 'required|string',
            'alias' => 'required|string',
            'user_id' => 'required|integer',
        ]);
        
		try{
            $bookmark = new Bookmark();
			$bookmark->fill($validated);
			if($bookmark->save()){
				$response = response()->json($bookmark,201);
			}
			
		}catch(Exception $e){
			$response = response()->json([
				'message' => $e->getMessage(),
	        ], 401);
		}

        RequestLogController::saveRequestLog($request, $response, 'Bookmark Gif');

        return $response;
    }
}
