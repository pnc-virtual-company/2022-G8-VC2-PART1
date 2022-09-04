<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyBackMail extends Mailable
{
    use Queueable, SerializesModels;

    public $leave;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($leave)
    {
        return $this->leave = $leave;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('soklimhin@gmail.com','Reply')->view('mailer.replyback')->subject('Reply Request');
        
    }
}
