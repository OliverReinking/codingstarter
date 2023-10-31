<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailJobApplication extends Mailable
{
    use Queueable, SerializesModels;

    public $job_application_values;

    public function __construct($job_application_values)
    {
        $this->job_application_values = $job_application_values;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Neue Bewerbung ist eingegangen',
        );
    }

    {
        return new Content(
            view: 'emails.home.job_application',
            with: [
                'job_application_values' => $this->job_application_values,
            ],

        );
    }

}
