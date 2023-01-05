<?php

namespace App\Jobs;

use Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\MailNewsletterWasSubscribed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendMailNewsletterWasSubscribed implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $newsletter_values;

    public function __construct($newsletter_values)
    {
        $this->newsletter_values = $newsletter_values;
    }

    public function handle()
    {
        $email = new MailNewsletterWasSubscribed($this->newsletter_values);
        //
        Mail::to($this->newsletter_values->email)
            ->send($email);
    }
}
