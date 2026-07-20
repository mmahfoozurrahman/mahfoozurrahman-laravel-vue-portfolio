<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'description',
        'long_description',
        'is_featured',
        'status',
        'tech_stack',
        'demo_url',
        'github_url',
        'image_path',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'tech_stack' => 'array',
        'sort_order' => 'integer',
    ];
}
