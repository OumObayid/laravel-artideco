<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewOrderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $product;

    public function __construct($order, $product)
    {
        $this->order = $order;
        $this->product = $product;
    }

    public function build()
    {
        return $this->subject('Nouvelle commande reçue')
                    ->view('emails.new_order')
                    ->with([
                        'order' => $this->order,
                        'product' => $this->product,
                    ]);
    }
}
