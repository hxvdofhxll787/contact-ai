<?php

namespace App\Repositories;

use App\Models\Contact;

class ContactRepository
{
    public function create(array $data): Contact
    {
        return Contact::create($data);
    }

    public function count(): int
    {
        return Contact::count();
    }
}
