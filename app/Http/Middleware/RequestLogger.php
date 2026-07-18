<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\RequestLogService;

class RequestLogger
{
    public function __construct(
        private RequestLogService $requestLogService,
    ) {}

    public function handle(Request $request, Closure $next): Response
    {
        $startedAt = microtime(true);

        $response = $next($request);

        $this->requestLogService->log($request, $response, $startedAt);

        return $response;
    }
}
