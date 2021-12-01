<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMailCursoAlumno extends Mailable
{
    use Queueable, SerializesModels;
    public $curso;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($curso)
    {
        $this->curso = $curso;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.welcome-curso-alumno')
            ->from('no-reply@pymis.com.pe')
            ->subject('Inscripcion de curso');
    }
}
