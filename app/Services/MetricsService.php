<?php

namespace App\Services;

use App\Repositories\ContactRepository;
use App\Repositories\RequestLogRepository;

class MetricsService
{
    public function __construct(
        private ContactRepository $contactRepository,
        private RequestLogRepository $requestLogRepository,
    ) {}

    public function get(): array
    {
        return [
            'contacts' => [
                'total' => $this->contactRepository->count(),
                'today' => $this->contactRepository->countToday(),
            ],

            'requests' => [
                'total' => $this->requestLogRepository->count(),
                'failed' => $this->requestLogRepository->countFailed(),
            ],

            'sentiments' => $this->contactRepository->countSentiment(),

            'categories' => $this->contactRepository->countCategory(),
        ];
    }
}
