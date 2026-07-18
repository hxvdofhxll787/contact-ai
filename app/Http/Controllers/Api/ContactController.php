<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Services\ContactService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(
        private ContactService $contactService,
    ) {}

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
