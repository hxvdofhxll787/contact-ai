<?php

namespace App\Services;

use App\Repositories\ContactRepository;

class ContactService
{
    public function __construct(
        private ContactRepository $contactRepository,
        private AIService $aiService,
    ) {}

    public function create(array $data)
    {
        $analysis = $this->aiService->analyze($data['comment']);

        $contact = $this->contactRepository->create([
            ...$data,
        ]);

        return $contact;
    }
}
