<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteData extends Model
{
    use HasFactory;
    protected $fillable = [
        'phone',
        'email',
        'owner_name',
        'site_title',
        'currency_sign',
        'currency_code',
        'site_logo',
        'favicon',
        'stripe_public_key',
        'stripe_secret_key',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'instagram_url',
        'meta_description',
        'meta_keywords',
        'contact_address',
        'contact_city',
        'contact_state',
        'contact_zip',
        'contact_country',
        'additional_data',
    ];

    protected $casts = [
        'additional_data' => 'array',
    ];
}

