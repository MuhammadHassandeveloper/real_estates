<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRentalSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $propertyRental;

    public function __construct($propertyRental)
    {
        $this->propertyRental = $propertyRental;
    }

    public function build()
    {
        return $this->view('emails.user_rental_success')
            ->subject('Property Rental Confirmation')
            ->with(['propertyRental' => $this->propertyRental]);
    }
}
