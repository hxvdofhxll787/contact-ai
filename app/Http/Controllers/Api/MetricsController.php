<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Services\MetricsService;
use OpenApi\Attributes as OA;

class MetricsController extends Controller
{
    public function __construct(
        private MetricsService $metricsService
    ) {}


    #[OA\Get(
        path: "/api/metrics",
        summary: "Получить метрики",
        tags: ["Metrics"],

        responses: [
            new OA\Response(
                response: 200,
                description: "Application statistics",

                content: new OA\JsonContent(
                    properties: [

                        new OA\Property(
                            property: "contacts",
                            type: "object",
                            example: [
                                "total" => 25,
                                "today" => 3
                            ]
                        ),

                        new OA\Property(
                            property: "requests",
                            type: "object",
                            example: [
                                "total" => 100,
                                "failed" => 5
                            ]
                        ),

                        new OA\Property(
                            property: "sentiments",
                            type: "object",
                            example: [
                                "positive" => 10,
                                "neutral" => 8,
                                "negative" => 2
                            ]
                        ),

                        new OA\Property(
                            property: "categories",
                            type: "object",
                            example: [
                                "question" => 5,
                                "feedback" => 3,
                                "complaint" => 1,
                                "partnership" => 4
                            ]
                        )
                    ]
                )
            )
        ]
    )]
    public function __invoke(): JsonResponse
    {
        return response()->json(
            $this->metricsService->get()
        );
    }
}
