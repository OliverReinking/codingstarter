<?php

namespace App\Jobs;

use Mail;
use Illuminate\Bus\Queueable;
use App\Mail\MailInvitationTeamMember;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class SendMailInvitationTeamMember implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $invitation_values;

    public function __construct($invitation_values)
    {
        $this->invitation_values = $invitation_values;
    }

    public function handle()
    {
        $email = new MailInvitationTeamMember($this->invitation_values);
        //
        Mail::to($this->invitation_values->email)
            ->send($email);
    }
}
