<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNewsletterWasSubscribed extends Mailable
{
    use Queueable, SerializesModels;

    public $newsletter_values;

    public function __construct($newsletter_values)
    {
        $this->newsletter_values = $newsletter_values;
    }

    public function build()
    {
        return $this
            ->subject('Newsletter abonniert')
            ->markdown('emails.home.newsletter_was_subscribed')
            ->with('newsletter_values', $this->newsletter_values);
    }
}
