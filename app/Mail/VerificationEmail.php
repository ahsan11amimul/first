<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class VerificationEmail extends Mailable
{
    use Queueable, SerializesModels;
    private $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
       $this->user=$user;
    }

    /**
     * Build the message.
     *
     * @return $this   
     */
    public function build()
    {
        $user=$this->user;
        return $this->view('email.verification',\compact('user'));
    }
}
