<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AgentRentalSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $propertyRental;

    public function __construct($propertyRental)
    {
        $this->propertyRental = $propertyRental;
    }

    public function build()
    {
        return $this->view('emails.agent_rental_success')
            ->subject('New Property Rental Notification')
            ->with(['propertyRental' => $this->propertyRental]);
    }

}
