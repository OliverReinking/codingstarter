<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailInvitationTeamMember extends Mailable
{
    use Queueable, SerializesModels;

    public $invitation_values;

    public function __construct($invitation_values)
    {
        $this->invitation_values = $invitation_values;
    }

    public function build()
    {
        return $this
            ->subject('Einladung')
            ->markdown('emails.home.invitation_as_team_member')
            ->with('invitation_values', $this->invitation_values);
    }
}
