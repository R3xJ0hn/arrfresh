<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    private $data;
    private $cart;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$cart)
    {
        $this->data = $data;
        $this->cart = $cart;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = $this->data;
        $cart = $this->cart;
        return $this->from('support@grocery.com')->view('mail.order_mail',compact('order','cart'))->subject('Email From ' . $order['company_name']);
    }

}
