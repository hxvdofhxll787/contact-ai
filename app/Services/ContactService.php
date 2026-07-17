<?php

namespace App\Services;

use App\Models\Contact;
use App\Repositories\ContactRepository;

class ContactService
{
    public function __construct(
        private ContactRepository $contactRepository,
    ) {}

    public function create(array $data)
    {
        $contact = $this->contactRepository->create([
            ...$data,
        ]);

        return $contact;
    }
}
