<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestLog;
use Illuminate\Support\Facades\Auth;


class RequestLogController extends Controller
{
    
    public static function saveRequestLog($request, $response, $serviceName){
        $data= [
            "user_id" => Auth::user()['id'],
            "service_name" => $serviceName,
            "request_body" => $request->all(),
            "http_status_code" => $response->getStatusCode(),
            "response_body" => $response->getContent(),
            "origin_ip" => $request->ip(),
        
        ];

		try{
            $requestLog = new RequestLog();
			$requestLog->fill($data);
			if($requestLog->save()){
				return response()->json($requestLog,201);
			}
			
            return response("Failed", 500);
		}catch(Exception $e){
			return response()->json([
				'message' => $e->getMessage(),
	        ], 401);
		}
    }
}
