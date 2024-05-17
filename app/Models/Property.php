<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;
    protected $table = 'properties';
    protected $fillable = [
        'title',
        'property_type_id',
        'agent_id',
        'property_features',
        'size_sqft',
        'price',
        'bedrooms',
        'bathrooms',
        'garages',
        'rooms',
        'address',
        'city',
        'state',
        'zip_code',
        'building_age',
        'short_description',
        'long_description',
        'owner_name',
        'owner_email',
        'owner_phone',
        'is_featured',
        'status',
    ];
}
