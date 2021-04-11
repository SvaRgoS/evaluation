<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactDeleted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Contact
     */
    private $contact;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->view('emails.contact.removed')
            ->with(['contact' => $this->contact]);
    }
}
