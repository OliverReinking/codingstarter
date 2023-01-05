<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailWebinarReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $remindervalues;

    public function __construct($remindervalues)
    {
        $this->remindervalues = $remindervalues;
    }

    public function build()
    {
        return $this
            ->subject('Erinnerung')
            ->markdown('emails.home.webinar_reminder')
            ->with('remindervalues', $this->remindervalues);
    }
}
