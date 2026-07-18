<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class AIService
{
    public function analyze(string $comment): array
    {
        try {

//            $prompt = <<<PROMPT
//                Проанализируй комментарий пользователя.
//                Верни только валидный JSON.
//
//                Доступные значения sentiment:
//                - Positive
//                - Neutral
//                - Negative
//
//                Доступные значения category:
//                - Question
//                - Feedback
//                - Complaint
//                - Partnership
//                - Other
//
//                JSON формат ответа:
//                {
//                    "sentiment": "",
//                    "category": ""
//                }
//
//                Комментарий пользователя:
//                {$comment}
//            PROMPT;
//
//            $response = Http::timeout(10)
//                ->post(
//                    'https://generativelanguage.googleapis.com/v1beta/models/gemini-3.5-flash:generateContent?key=' . config('services.gemini.api_key'),
//                    [
//                        'contents' => [
//                            [
//                                'parts' => [
//                                    [
//                                        'text' => $prompt,
//                                    ]
//                                ]
//                            ]
//                        ]
//                    ]
//                );
//
//            $data = $response->json();
//
//            $content = $data['candidates'][0]['content']['parts'][0]['text'];
//
//            $content = preg_replace('/```json\s*|\s*```/', '', $content);
//            $content = preg_replace('/```\s*|\s*```/', '', $content);
//
//            $result = json_decode($content, true);
//
//            return [
//                'sentiment' => $result['sentiment'] ?? 'Unknown',
//                'category' => $result['category'] ?? 'Unknown',
//            ];

            return [
                'sentiment' => 'Unknown',
                'category' => 'Unknown',
            ];

        } catch (\Throwable $e) {
            Log::error('AI error', [
                'message' => $e->getMessage(),
                'comment' => $comment,
            ]);

            return [
                'sentiment' => 'Unknown',
                'category' => 'Unknown',
            ];
        }
    }
}
