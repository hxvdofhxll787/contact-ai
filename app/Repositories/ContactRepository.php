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

    public function countSentiment(): array
    {
        return Contact::query()
            ->selectRaw('sentiment, COUNT(*) as total')
            ->groupBy('sentiment')
            ->pluck('total', 'sentiment')
            ->toArray();
    }

    public function countCategory(): array
    {
        return Contact::query()
            ->selectRaw('category, COUNT(*) as total')
            ->groupBy('category')
            ->pluck('total', 'category')
            ->toArray();
    }
}
