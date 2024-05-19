<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyFeature extends Model
{
    use HasFactory;
    protected $table = 'property_features';
    protected $fillable = [
        'name',
    ];

    public function properties()
    {
        return $this->belongsToMany(Property::class, 'property_features');
    }
}
