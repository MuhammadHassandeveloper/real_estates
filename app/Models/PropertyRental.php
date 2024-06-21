<?php

// app/Models/PropertyRental.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyRental extends Model
{
    use HasFactory;

    protected $table = 'property_rentals';

    protected $fillable = [
        'customer_id',
        'property_id',
        'agent_id',
        'rental_price',
        'start_date',
        'end_date',
        'payment_method',
        'payment_stripe_id',
        'status',
        'payment_status',
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
