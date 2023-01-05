<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailWebinarRegistrationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $registrationvalues;

    public function __construct($registrationvalues)
    {
        $this->registrationvalues = $registrationvalues;
    }

    public function build()
    {
        return $this
            ->subject('Anmeldebestätigung')
            ->markdown('emails.home.webinar_registration_confirmation')
            ->with('registrationvalues', $this->registrationvalues);
    }
}
