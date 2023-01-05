<?php

namespace App\Jobs;

use Mail;
use App\Mail\MailNewChat;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendMailNewChat implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $chat_values;

    public function __construct($chat_values)
    {
        $this->chat_values = $chat_values;
    }

    public function handle()
    {
        //
        $email = new MailNewChat($this->chat_values);
        //
        Mail::to($this->chat_values->receiver_email)
            ->cc($this->chat_values->sender_email)
            ->send($email);
    }
}
