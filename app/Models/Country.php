<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'country_code', 'currency_sign', 'currency', 'status'];

    // A country has many states
    public function states()
    {
        return $this->hasMany(State::class);
    }

    // A country has many cities
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    // A country has many users
    public function users()
    {
        return $this->hasMany(User::class);
    }

    // A country has many properties
    public function properties()
    {
        return $this->hasMany(Property::class);
    }
}
