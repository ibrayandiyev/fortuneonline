<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MOperacion extends Mailable implements ShouldQueue{
    use Queueable, SerializesModels;

    public $contenido;

    public function __construct($contenido){
        $this->contenido=$contenido;
    }
    public function build(){

        $auth=[];
        $auth['email']=\Auth::User()->email;

        return $this->from($auth['email'])->view('mail.operacion')->subject("Asunto");
    }
}
