<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNewChat extends Mailable
{
    use Queueable, SerializesModels;

    public $chat_values;

    public function __construct($chat_values)
    {
        $this->chat_values = $chat_values;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Eine neue Nachricht in der Plattform " . config('platform.name');
        return $this
            ->subject($subject)
            ->markdown('emails.application.new_chat')
            ->with('chat_values', $this->chat_values);
    }
}
