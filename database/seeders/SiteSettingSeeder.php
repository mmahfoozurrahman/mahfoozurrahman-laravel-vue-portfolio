<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteSetting::create([
            'owner_name' => 'Mahfoozur Rahman',
            'owner_role' => 'Full-Stack Web Developer',
            'owner_bio' => 'I am a self-taught full-stack web developer with nearly a decade of experience shipping secure SaaS products, vertical POS/CRM tools, and highly interactive applications. I build clean, modular architectures using Laravel, Inertia.js, and Vue 3, focusing on craftsman-level code that scales.',
            'owner_avatar' => null,
            'location' => 'Dhaka, Bangladesh',
            'relocation_notice' => 'Highly open to remote full-time contracts and relocation to Tokyo or Osaka, Japan. Eligible for an Engineer Visa sponsorship.',
            'resume_url' => 'assets/docs/resume.pdf',
            'email' => 'mahfoozur.rahman@example.com',
            'linkedin_url' => 'https://linkedin.com/in/mahfoozur-rahman',
            'github_url' => 'https://github.com/mahfoozur-rahman',
            'ai_assistant_welcome' => 'Hello! I am Mahfoozur\'s digital twin. Ask me anything about my tech stack, Tokyo relocation eligibility, or SaaS project architecture!',
            'meta_description' => 'Mahfoozur Rahman - Senior Laravel, Inertia.js, and Vue 3 developer crafting secure, high-performance SaaS tools and multi-tenant applications.',
        ]);
    }
}
