<?php

namespace App\Jobs;

use Mail;
use Illuminate\Bus\Queueable;
use App\Mail\MailWebinarReminder;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendMailWebinarReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $remindervalues;

    public function __construct($remindervalues)
    {
        $this->remindervalues = $remindervalues;
    }

    public function handle()
    {
        $email = new MailWebinarReminder($this->remindervalues);
        Mail::to($this->remindervalues->email)
            ->send($email);
    }

}
