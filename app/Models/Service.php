<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'tagline',
        'description',
        'icon',
        'features',
        'tech_stack',
        'order',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',
        'tech_stack' => 'array',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
