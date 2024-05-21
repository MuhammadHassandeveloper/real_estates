<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityReport extends Model
{
    use HasFactory;

    protected $table = 'activity_report';
    protected $fillable = [
        'user_id',
        'system_id',
        'heading',
        'content',
        'color',
        'type',
        'role',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

