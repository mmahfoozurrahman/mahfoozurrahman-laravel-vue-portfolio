<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GithubRepo extends Model
{
    protected $fillable = [
        'repo_id',
        'name',
        'description',
        'stars_count',
        'forks_count',
        'language',
        'repo_url',
        'pushed_at',
    ];

    protected $casts = [
        'repo_id' => 'integer',
        'stars_count' => 'integer',
        'forks_count' => 'integer',
        'pushed_at' => 'datetime',
    ];
}
