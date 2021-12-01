<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class MailUpdateNotas extends Mailable
{
    use Queueable, SerializesModels;
    public $nota;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nota)
    {
        $this->nota = $nota;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.update-nota')
            ->from('no-reply@pymis.com.pe')
            ->subject('Actualizacion de notas');
    }
}
