<?php

namespace Tests\Feature;

use App\Mail\ContactConfirmation;
use App\Mail\ContactNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_send_contact_request(): void
    {
        Http::fake([
            'https://generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                [
                                    'text' => json_encode([
                                        'sentiment' => 'Positive',
                                        'category' => 'Partnership',
                                    ]),
                                ],
                            ],
                        ],
                    ],
                ],
            ], 200),
        ]);

        Mail::fake();

        $payload = [
            'name' => 'Иван',
            'email' => 'ivan@example.com',
            'phone' => '+79991234567',
            'comment' => 'Хочу заказать разработку сайта.',
        ];

        $response = $this->postJson('/api/contact', $payload);

        $response->assertCreated();

        $this->assertDatabaseHas('contacts', [
            'email' => 'ivan@example.com',
            'sentiment' => 'Positive',
            'category' => 'Partnership',
        ]);

        Mail::assertSent(ContactNotification::class);
        Mail::assertSent(ContactConfirmation::class);
    }

    public function test_contact_request_validation_errors(): void
    {
        Mail::fake();
        Http::fake();

        $response = $this->postJson('/api/contact', []);

        $response
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'name',
                'email',
                'phone',
                'comment'
            ]);

        $this->assertDatabaseCount('contacts', 0);

        Mail::assertNothingSent();
    }

    public function test_rate_limiting(): void
    {
        Http::fake([
            'https://generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                [
                                    'text' => json_encode([
                                        'sentiment' => 'Positive',
                                        'category' => 'Partnership',
                                    ]),
                                ],
                            ],
                        ],
                    ],
                ],
            ], 200),
        ]);

        Mail::fake();

        $payload = [
            'name' => 'Иван',
            'email' => 'ivan@example.com',
            'phone' => '+79991234567',
            'comment' => 'Хочу заказать разработку сайта.',
        ];

        for ($i = 0; $i < 5; $i++) {
            $this->postJson('/api/contact', $payload);
        }

        $response = $this->postJson('/api/contact', $payload);

        $response->assertStatus(429);
    }
}
