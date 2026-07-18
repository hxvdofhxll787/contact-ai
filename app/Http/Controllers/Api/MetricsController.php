<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Services\MetricsService;

class MetricsController extends Controller
{
    public function __construct(
        private MetricsService $metricsService
    ) {}

    public function __invoke(): JsonResponse
    {
        return response()->json(
            $this->metricsService->get()
        );
    }
}
