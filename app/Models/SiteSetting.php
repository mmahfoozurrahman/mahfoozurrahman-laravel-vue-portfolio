<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'owner_name',
        'owner_role',
        'owner_bio',
        'owner_avatar',
        'location',
        'relocation_notice',
        'resume_url',
        'email',
        'linkedin_url',
        'github_url',
        'ai_assistant_welcome',
        'meta_description',
    ];
}
