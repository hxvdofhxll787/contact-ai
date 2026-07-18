<?php

namespace App\Services;

use App\Mail\ContactConfirmation;
use App\Mail\ContactNotification;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function sendOwnerNotification(Contact $contact): void
    {
        Mail::to(config('mail.owner_address'))
            ->send(new ContactNotification($contact));
    }

    public function sendUserConfirmation(Contact $contact): void
    {
        Mail::to($contact->email)
            ->send(new ContactConfirmation($contact));
    }
}
