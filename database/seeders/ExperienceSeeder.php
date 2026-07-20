<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Experience::create([
            'role_title' => 'Senior Laravel Developer',
            'company' => 'Remote Development',
            'location' => 'Remote',
            'start_date' => '2022',
            'end_date' => 'Present',
            'is_featured' => true,
            'accomplishments' => [
                'Architect secure multi-tenant financial SaaS tools and microservices in Laravel.',
                'Build highly responsive, smooth frontend routing architectures using Inertia.js and Vue 3.',
                'Design optimized relational database structures and manage complex query tuning with MySQL.',
                'Maintain code review standards, mentoring junior developers in clean architecture, Git practices, and SOLID design patterns.',
            ],
            'skills' => ['Laravel 11', 'Inertia.js', 'Vue 3', 'MySQL', 'Redis', 'Docker', 'Git'],
            'image_path' => 'assets/images/experience-placeholder.svg',
            'sort_order' => 1,
        ]);

        Experience::create([
            'role_title' => 'Full-Stack PHP Developer',
            'company' => 'Dhaka, Bangladesh',
            'location' => 'Dhaka, Bangladesh',
            'start_date' => '2019',
            'end_date' => '2022',
            'is_featured' => false,
            'accomplishments' => [
                'Engineered custom enterprise Resource Planning (ERP) systems and Content Management architectures.',
                'Programmed reliable RESTful API structures using custom MVC frameworks and CakePHP.',
                'Developed fluid interfaces and integrated payment/billing gateways for service providers.',
                'Decreased database load by 35% through custom query profiling and table index tuning.',
            ],
            'skills' => ['CakePHP', 'Plain PHP MVC', 'JavaScript', 'Bootstrap 5', 'MySQL', 'API Integrations'],
            'image_path' => 'assets/images/experience-placeholder.svg',
            'sort_order' => 2,
        ]);

        Experience::create([
            'role_title' => 'Junior Web Developer',
            'company' => 'Dhaka, Bangladesh',
            'location' => 'Dhaka, Bangladesh',
            'start_date' => '2016',
            'end_date' => '2019',
            'is_featured' => false,
            'accomplishments' => [
                'Designed, programmed, and published standard business showcase sites and WordPress blogs.',
                'Translated client Photoshop/Figma templates into pixel-perfect, responsive HTML5/CSS3 markups.',
                'Configured and managed cPanel hosting systems, domain operations, and local server environments.',
                'Assisted in building small utility features and writing basic relational SQL scripts.',
            ],
            'skills' => ['Plain PHP', 'HTML5 & CSS3', 'JavaScript', 'jQuery', 'WordPress', 'MySQL'],
            'image_path' => 'assets/images/experience-placeholder.svg',
            'sort_order' => 3,
        ]);
    }
}
