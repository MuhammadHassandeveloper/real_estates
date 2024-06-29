<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $customerMessage;

    public function __construct(Message $message)
    {
        $this->customerMessage = $message;
    }

    public function build()
    {
        return $this->view('emails.customer_message')
            ->subject('New Inquiry About Your Property');
    }
}
