<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class RequestResponseLogger
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate(\Illuminate\Http\Request $request, \Illuminate\Http\Response $response)
    {
        if (json_decode(file_get_contents('php://input'), true)) {
            $_REQUEST = json_decode(file_get_contents('php://input'), true);
        }

        Log::info('api call: response: ' . json_encode([
                'request' => [
                    'headers' => collect($request->headers->all())->map(function ($header) {
                        return count($header) ? $header[0] : $header;
                    }),
                    'url' => $request->url(),
                    'content' => $_REQUEST,
                    'method' => $request->method()
                ],
                'response' => [
                    'headers' => collect($response->headers->all())->map(function ($header) {
                        return count($header) ? $header[0] : $header;
                    }),
                    'content' => json_decode($response->getContent())
                ]
            ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT));
    }
}
