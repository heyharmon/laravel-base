<?php

namespace DDD\Domain\Base\Invitations\Mail;

use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;

class InvitationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $invitation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invitation)
    {
        $this->invitation = $invitation;
    }

    /**
     * Build the message.
     */
    public function build(): static
    {
        // return $this->view('emails.invitation');
        return $this->subject('You\'ve been invited to join the BloomCU team')
            ->view('emails.invitation');
    }
}
