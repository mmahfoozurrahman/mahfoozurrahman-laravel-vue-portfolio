<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'role_title',
        'company',
        'location',
        'start_date',
        'end_date',
        'is_featured',
        'accomplishments',
        'skills',
        'image_path',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'accomplishments' => 'array',
        'skills' => 'array',
        'sort_order' => 'integer',
    ];
}
