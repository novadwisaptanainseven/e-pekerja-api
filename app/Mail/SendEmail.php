<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $req;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($req = null)
    {
        $this->req = $req;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Kenaikan Pangkat Golongan";
        if ($this->req) {
            return $this->subject($subject)
                ->markdown('emails.email', ["req" => $this->req]);
        } else {
            return $this->subject($subject)
                ->markdown('emails.email-design');
        }
    }
}
