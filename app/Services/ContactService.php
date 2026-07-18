<?php

namespace App\Services;

use App\Repositories\ContactRepository;
use App\Repositories\RequestLogRepository;

class ContactService
{
    public function __construct(
        private ContactRepository $contactRepository,
        private RequestLogRepository $requestLogRepository,
        private AIService $aiService,
        private MailService $mailService,
    ) {}

    public function create(array $data)
    {
        $analysis = $this->aiService->analyze($data['comment']);

        $contact = $this->contactRepository->create([
            ...$data,

            'sentiment' => $analysis['sentiment'],
            'category' => $analysis['category'],
        ]);



        $this->mailService->sendOwnerNotification($contact);
        $this->mailService->sendUserConfirmation($contact);

        return $contact;
    }
}
