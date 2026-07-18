<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Services\ContactService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class ContactController extends Controller
{
    public function __construct(
        private ContactService $contactService,
    ) {}

    #[OA\Post(
        path: "/api/contact",
        summary: "Отправить комментарий",
        tags: ["Contact"],

        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: [
                    "name",
                    "email",
                    "phone",
                    "comment"
                ],

                properties: [
                    new OA\Property(
                        property: "name",
                        type: "string",
                        example: "Александр"
                    ),

                    new OA\Property(
                        property: "email",
                        type: "string",
                        example: "alex@example.com"
                    ),

                    new OA\Property(
                        property: "phone",
                        type: "string",
                        example: "+79999999999"
                    ),

                    new OA\Property(
                        property: "comment",
                        type: "string",
                        example: "Я хочу создать веб-сайт"
                    ),
                ]
            )
        ),

        responses: [
            new OA\Response(
                response: 201,
                description: "Contact request created"
            ),

            new OA\Response(
                response: 422,
                description: "Validation error"
            ),

            new OA\Response(
                response: 429,
                description: "Too many requests"
            )
        ]
    )]
    public function store(ContactRequest $request): JsonResponse
    {
        $contact = $this->contactService->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Contact successfully created.',
            'data' => [
                'id' => $contact->id,
                'sentiment' => $contact->sentiment,
                'category' => $contact->category,
            ]
        ], 201);
    }
}
