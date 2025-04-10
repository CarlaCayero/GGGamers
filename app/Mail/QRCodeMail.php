<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QRCodeMail extends Mailable
{
    use Queueable, SerializesModels;
    public $qrCode;
    public $evento;
    /**
     * Create a new message instance.
     */
    public function __construct(string $qrCode, array $evento)
    {
        $this->qrCode = $qrCode;
        $this->evento = $evento;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Q R Code Mail',
        );
    }


    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }

    public function build()
    {
        return $this->subject('Tu código QR para el evento')
                    ->view('emails.qrcode')
                    ->with([
                        'evento' => $this->evento,
                    ])
                    ->attachData(base64_decode(substr($this->qrCode, strpos($this->qrCode, ',') + 1)), 'qrcode.png', [
                        'mime' => 'image/png',
                    ]);
    }
}
