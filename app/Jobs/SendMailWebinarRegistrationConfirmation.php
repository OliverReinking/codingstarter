<?php

namespace App\Jobs;

use Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use App\Mail\MailWebinarRegistrationConfirmation;

class SendMailWebinarRegistrationConfirmation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $registrationvalues;

    public function __construct($registrationvalues)
    {
        $this->registrationvalues = $registrationvalues;
    }

    public function handle()
    {
        $email = new MailWebinarRegistrationConfirmation($this->registrationvalues);
        Mail::to($this->registrationvalues->email)
            ->send($email);
    }
}
