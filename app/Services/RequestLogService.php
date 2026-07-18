<?php

namespace App\Services;
use App\Repositories\RequestLogRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestLogService
{
    public function __construct(
        private RequestLogRepository $requestLogRepository,
    ) {}

    public function log(
        Request $request,
        Response $response,
        float $startedAt,
    ): void {
        $this->requestLogRepository->create([
            'ip' => $request->ip(),
            'method' => $request->method(),
            'url' => $request->path(),
            'status_code' => $response->getStatusCode(),
            'request' => $request->all(),
            'response' => json_decode($response->getContent(), true),
            'duration_ms' => (int) ((microtime(true) - $startedAt) * 1000),
        ]);
    }
}
