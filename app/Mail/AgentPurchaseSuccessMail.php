<?php


namespace App\Mail;

use App\Models\PropertyPurchase;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AgentPurchaseSuccessMail extends Mailable
{
    use Queueable, SerializesModels;

    public $propertyPurchase;

    public function __construct(PropertyPurchase $propertyPurchase)
    {
        $this->propertyPurchase = $propertyPurchase;
    }

    public function build()
    {
        return $this->view('emails.agent_purchase_success')
            ->with('propertyPurchase', $this->propertyPurchase);
    }
}

