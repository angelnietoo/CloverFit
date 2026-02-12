<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use SerializesModels;

    public $name;
    public $email;
    public $message;

    public function __construct($data)
    {
        $this->name = $data->name;
        $this->email = $data->email;
        $this->message = $data->message;
    }

    public function build()
    {
        return $this->subject('Nuevo mensaje de contacto')
                    ->view('emails.contact');
    }
}
