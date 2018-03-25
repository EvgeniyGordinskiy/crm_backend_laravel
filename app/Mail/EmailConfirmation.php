<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    private $user;

    /**
     * EmailConfirmation constructor.
     * @param \App\Models\User $user
     * @param string $token
     */
    public function __construct(\App\Models\User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = route('confirm.email.confirm', ['token' => $this->user->token]);
        return $this
            ->to($this->user->email)
            ->markdown('emails.confirmation')
            ->with(['url' => $url]);
    }

}
