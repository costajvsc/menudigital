<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CreatePedido extends Mailable
{
    use Queueable, SerializesModels;

    public $pedido;
    public $itens;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pedido, $itens)
    {
        $this->pedido = $pedido;
        $this->itens = $itens;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.CreatePedido');
    }
}
