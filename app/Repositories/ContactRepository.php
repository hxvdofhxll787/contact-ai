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

    public function countToday(): int
    {
        return Contact::whereDate('created_at', today())->count();
    }

    public function countSentiment(string $sentiment): int
    {
        return Contact::where('sentiment', $sentiment)->count();
    }
}
