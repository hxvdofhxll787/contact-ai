<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class AIService
{
    public function analyze(string $comment): array
    {
        try {
            return [
                'sentiment' => 'neutral',
                'category' => 'other',
            ];
        } catch (\Throwable $e) {
            Log::error('AI error', [
                'message' => $e->getMessage(),
                'comment' => $comment,
            ]);

            return [
                'sentiment' => 'error',
                'category' => 'other',
            ];
        }
    }
}
