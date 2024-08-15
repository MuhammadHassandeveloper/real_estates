<?php

// app/Models/PropertyNearbyPlace.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyNearbyPlace extends Model
{
    use HasFactory;

    protected $fillable = ['property_id', 'name', 'type', 'address', 'distance'];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
}
