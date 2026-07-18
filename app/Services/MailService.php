<?php

namespace App\Services;

use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function sendOwnerNotification(Contact $contact): void
    {
        Mail::to(config('mail.owner_address'))
            ->send();
    }

    public function sendUserCinfirmation(Contact $contact): void
    {
        Mail::to(config($contact->email))->send();
    }
}
