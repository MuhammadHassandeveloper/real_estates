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
        'agency_id',
        'property_category',
        'property_features',
        'size_sqft',
        'price',
        'bedrooms',
        'bathrooms',
        'garages',
        'rooms',
        'address',
        'city_id', // Changed to city_id
        'state_id', // Changed to state_id
        'zip_code',
        'building_age',
        'short_description',
        'long_description',
        'owner_name',
        'owner_email',
        'owner_phone',
        'is_featured',
        'rental_duration',
        'status',
        'latitude',
        'longitude',
        'floor_plan',
        'video_url',
    ];

    // Define relationships

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

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
