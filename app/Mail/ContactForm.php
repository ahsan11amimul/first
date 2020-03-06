<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Contact;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;
    private $contact;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contact $contact)
    {
       $this->contact=$contact;
    }

    /**
     * Build the message.
     *
     * @return $this   
     */
    public function build()
    {
        $contact=$this->contact;
        return $this->view('email.contactForm',\compact('contact'));
    }
}
