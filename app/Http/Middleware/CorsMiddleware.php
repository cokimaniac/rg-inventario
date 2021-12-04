<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware {
    /**
     * Handle incoming requests
     * 
     * @param \Illmuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $headers = [
            "Access-Control-Allow-Origin" => "*",
            "Access-Control-Allow-Methods" => "POST, GET, DELETE, PUT, PATCH, OPTIONS",
            "Access-Control-Allow-Credentials" => TRUE,
            "Access-Control-Max-Age" => 86400,
            "Access-Control-Allow-Headers" => "Content-Type, Authorization, X-Requested-With, api_token"
        ];

        if ($request->isMethod("OPTIONS")) {
            return response()->json("{method: OPTIONS}", 200, $headers);
        }

        $response = $next($request);

        foreach($headers as $key => $value) {
            $response->header($key, $value);
        }

        return $response;
    }
}