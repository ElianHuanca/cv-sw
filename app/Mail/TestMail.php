<?php

namespace App\Mail;

use App\Models\Entrevistas;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $id;
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Embol Te Quiere Entrevistar',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            //view: 'view.name',
            view: 'testmail',
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
        $entrevista = Entrevistas::join('postulaciones', 'entrevistas.idpostulacion', '=', 'postulaciones.id')
            ->join('trabajos', 'postulaciones.idtrabajo', '=', 'trabajos.id')
            ->join('sucursales', 'trabajos.idsucursal', '=', 'sucursales.id')
            ->join('users', 'entrevistas.iduser', '=', 'users.id')
            ->select(
                'entrevistas.fecha',
                'entrevistas.hora',
                'sucursales.direccion as direccion',
                'sucursales.ciudad as ciudad',
                'sucursales.latitud',
                'sucursales.longitud',
                'users.name as entrevistador'
            )
            ->where('entrevistas.id', $this->id)
            ->first();
        return $this->from('huancacori@gmail.com', env('MAIL_FROM_NAME'))
            //->subject('Embol Te Quiere Entrevistar')
            //->view('testmail')
            ->with(['entrevista' => $entrevista->toArray()]);
    }
}
