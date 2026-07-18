<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class HealthController extends Controller
{

    #[OA\Get(
        path: "/api/health",
        summary: "Проверить статус сервиса",
        tags: ["Health"],

        responses: [
            new OA\Response(
                response: 200,
                description: "Service is running",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: "status",
                            type: "string",
                            example: "ok"
                        ),

                        new OA\Property(
                            property: "timestamp",
                            type: "string",
                            example: "2026-07-18T12:00:00Z"
                        ),

                        new OA\Property(
                            property: "app",
                            type: "string",
                            example: "Contact AI"
                        ),

                        new OA\Property(
                            property: "version",
                            type: "string",
                            example: "1.0.0"
                        )
                    ]
                )
            )
        ]
    )]
    public function __invoke(): JsonResponse
    {
        return response()->json([
            'status' => 'ok',
            'timestamp' => now()->toISOString(),
            'app' => config('app.name'),
            'version' => '1.0.0',
        ]);
    }
}
