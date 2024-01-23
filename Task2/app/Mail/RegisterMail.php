<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $link;


    public function __construct($link)
    {
        $this->link = $link;
    }

    public function build()
    {
        return $this->view('email.register');
    }
}

