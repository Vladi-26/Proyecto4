<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;

class Codigo2FAMail extends Mailable
{
    use Queueable, SerializesModels;

    // 1. Declaramos la variable pública
    public $codigo;

    // 2. La recibimos en el constructor
    public function __construct($codigoRecibido)
    {
        $this->codigo = $codigoRecibido;
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.codigo2fa', // Asegúrate que diga esto
        );
    }
}