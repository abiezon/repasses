<?php

namespace App\Mail;

use App\Launch;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LaunchMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $launch;

    public function __construct(Launch $launch)
    {
        $this->launch = $launch;
    }

    public function build()
    {
        return $this->subject('Documento Cadastrado para sua visualização!')
            ->from(env('MAIL_FROM_ADDRESS'))
            ->markdown('email.default')
            ->with([
                'name' => $this->launch->description,
                'title' => 'Lançamento de Documentos',
                'message_header' => 'Documentos para você visualizar'
            ]);
    }

}