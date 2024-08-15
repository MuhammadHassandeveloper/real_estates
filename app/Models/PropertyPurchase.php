<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyPurchase extends Model
{
    use HasFactory;

    protected $table = 'property_purchases';

    protected $fillable = [
        'customer_id',
        'property_id',
        'agent_id',
        'purchased_price',
        'purchased_date',
        'purchased_time',
        'payment_method',
        'payment_stripe_id',
        'purchased_status',
        'purchased_payment_status',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }
}
