<?php


namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPropertyNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $property;
    public $agent;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($property, $agent)
    {
        $this->property = $property;
        $this->agent = $agent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Property Created')
            ->view('emails.new_property_notification');
    }
}
