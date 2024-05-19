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
        'property_category',
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

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class, 'property_id');
    }

    public function features()
    {
        return $this->belongsToMany(PropertyFeature::class, 'property_features');
    }
}
