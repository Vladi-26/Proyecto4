<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VentaValidadaComprador extends Mailable
{
    use Queueable, SerializesModels;

    // Definimos la propiedad pública para que esté disponible en la vista del correo
    public $venta;

    /**
     * Create a new message instance.
     * Recibe el objeto Venta desde el controlador
     */
    public function __construct($venta)
    {
        $this->venta = $venta;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '¡Tu compra ha sido validada exitosamente!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            // Asegúrate de crear este archivo en resources/views/emails/venta_comprador.blade.php
            view: 'emails.venta_comprador',
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}