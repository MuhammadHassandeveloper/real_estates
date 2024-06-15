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
        'country_id',
        'city_id',
        'state_id',
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
    ];

    // Define relationships

    public function agent()
    {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function agency()
    {
        return $this->belongsTo(User::class, 'agency_id');
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class, 'property_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function getPropertyFeaturesAttribute($value)
    {
        return json_decode($value);
    }

    public function setPropertyFeaturesAttribute($value)
    {
        $this->attributes['property_features'] = json_encode($value);
    }

    public function features()
    {
        return PropertyFeature::whereIn('id', $this->property_features)->get();
    }
}
