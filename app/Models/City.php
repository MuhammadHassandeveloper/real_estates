<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'country_id', 'state_id'];

    // A city belongs to a state
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    // A city belongs to a country
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    // A city has many properties
    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
