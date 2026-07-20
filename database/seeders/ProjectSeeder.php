<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::create([
            'title' => 'Lilla Sushi',
            'slug' => 'lilla-sushi',
            'category' => 'restaurant',
            'description' => 'A high-performance live restaurant app and online ordering dashboard operating in France.',
            'long_description' => 'Full-featured online food ordering ecosystem deployed for a client operating in France. Designed with single-page-app fluidity using Inertia.js and dynamic shopping cart stores, synchronized to a high-density merchant order fulfillment panel.',
            'is_featured' => true,
            'status' => 'COMPLETED',
            'tech_stack' => ['Laravel', 'Vue 3', 'Inertia.js', 'MySQL'],
            'demo_url' => 'https://lillasushi.fr',
            'github_url' => null,
            'image_path' => 'assets/images/portfolio-placeholder.svg',
            'sort_order' => 1,
        ]);

        Project::create([
            'title' => 'Loan & Investment SaaS',
            'slug' => 'loan-investment-saas',
            'category' => 'saas',
            'description' => 'Multi-tenant financial SaaS platform with tenant separation, investment tracking, and custom calculators.',
            'long_description' => 'A high-performance, double-entry financial platform featuring complete tenant isolation, granular ledger logs, custom compound interest calculators, and real-time portfolio charts.',
            'is_featured' => false,
            'status' => 'COMPLETED',
            'tech_stack' => ['Laravel', 'Vue 3', 'MySQL', 'Chart.js'],
            'demo_url' => null,
            'github_url' => null,
            'image_path' => 'assets/images/portfolio-placeholder.svg',
            'sort_order' => 2,
        ]);

        Project::create([
            'title' => 'LaraCodeVault',
            'slug' => 'laracodevault',
            'category' => 'lms',
            'description' => 'A specialized Learning Management System and resource hub tailored for developers learning Laravel.',
            'long_description' => 'LaraCodeVault is an interactive education portal indexing video guides, custom snippets caches, and documentation tracks for junior developers aiming to master the Laravel ecosystem.',
            'is_featured' => false,
            'status' => 'COMPLETED',
            'tech_stack' => ['Laravel 11', 'Livewire', 'Tailwind CSS', 'SQLite'],
            'demo_url' => 'https://laracodevault.com',
            'github_url' => null,
            'image_path' => 'assets/images/portfolio-placeholder.svg',
            'sort_order' => 3,
        ]);

        Project::create([
            'title' => 'AI Coding Assistant SaaS',
            'slug' => 'ai-coding-assistant',
            'category' => 'saas',
            'description' => 'AI-powered developer tool featuring hybrid routing between Claude API and Groq models for code generation.',
            'long_description' => 'A modern developer workspace integrating hybrid AI routing: using ultra-fast Groq models for simple operations and routing complex requests to Claude 3.5 Sonnet to achieve high-accuracy code completion at minimal cost.',
            'is_featured' => false,
            'status' => 'BUILDING',
            'tech_stack' => ['Claude API', 'Groq', 'Laravel', 'Vue 3'],
            'demo_url' => null,
            'github_url' => null,
            'image_path' => 'assets/images/portfolio-placeholder.svg',
            'sort_order' => 4,
        ]);

        Project::create([
            'title' => 'ISP Billing Tracker',
            'slug' => 'isp-billing-tracker',
            'category' => 'pos',
            'description' => 'A vertical subscriber and invoice manager with dynamic bandwidth controls and automated bill generation.',
            'long_description' => 'Subscriber accounts manager tailored for local internet service providers. Automates PDF billing invoices generation, tracks late payments, and interfaces with MikroTik API for bandwidth control.',
            'is_featured' => false,
            'status' => 'COMPLETED',
            'tech_stack' => ['Laravel MVC', 'Bootstrap 5', 'MySQL', 'PDF Lib'],
            'demo_url' => null,
            'github_url' => null,
            'image_path' => 'assets/images/portfolio-placeholder.svg',
            'sort_order' => 5,
        ]);

        Project::create([
            'title' => 'Multi-vendor Marketplace',
            'slug' => 'multi-vendor-marketplace',
            'category' => 'e-commerce',
            'description' => 'E-commerce ecosystem separating buyer channels, merchant portals, and general admin settlements.',
            'long_description' => 'Enterprise-scale marketplace featuring Stripe Connect integration, multi-merchant product catalogs, separate buyer order dashboards, and general administrative ledger balances.',
            'is_featured' => false,
            'status' => 'COMPLETED',
            'tech_stack' => ['Laravel', 'Inertia.js', 'Vue 3', 'Stripe'],
            'demo_url' => null,
            'github_url' => null,
            'image_path' => 'assets/images/portfolio-placeholder.svg',
            'sort_order' => 6,
        ]);

        Project::create([
            'title' => 'Health Portal',
            'slug' => 'health-portal',
            'category' => 'health',
            'description' => 'Patient appointment management portal with specialized doctor queues and digital prescription templates.',
            'long_description' => 'Clinic operational scheduling web portal managing live doctor consultation queues, patient medical history folders, and digital prescription builder tools.',
            'is_featured' => false,
            'status' => 'COMPLETED',
            'tech_stack' => ['Laravel', 'Bootstrap 5', 'MySQL', 'REST API'],
            'demo_url' => null,
            'github_url' => null,
            'image_path' => 'assets/images/portfolio-placeholder.svg',
            'sort_order' => 7,
        ]);

        Project::create([
            'title' => 'Food Blog SaaS',
            'slug' => 'food-blog-saas',
            'category' => 'saas',
            'description' => 'A multi-user publication site where culinary writers host custom subdomains and share recipes.',
            'long_description' => 'Multi-tenant blogging architecture isolating subscriber databases, supporting wildcard DNS subdomains, and indexing rich SEO articles caches.',
            'is_featured' => false,
            'status' => 'COMPLETED',
            'tech_stack' => ['Laravel 10', 'Livewire', 'MySQL', 'Subdomains'],
            'demo_url' => null,
            'github_url' => null,
            'image_path' => 'assets/images/portfolio-placeholder.svg',
            'sort_order' => 8,
        ]);

        Project::create([
            'title' => 'LibraSys',
            'slug' => 'librasys',
            'category' => 'other',
            'description' => 'Integrated library management panel using Laravel 11, Inertia, and Vue 3 to index assets.',
            'long_description' => 'Physical asset tracking database managing book loans, student ledger records, over-due fine auto-calculations, and visual analytics dashboards.',
            'is_featured' => false,
            'status' => 'COMPLETED',
            'tech_stack' => ['Laravel 11', 'Inertia.js', 'Vue 3', 'Postgres'],
            'demo_url' => null,
            'github_url' => null,
            'image_path' => 'assets/images/portfolio-placeholder.svg',
            'sort_order' => 9,
        ]);

        Project::create([
            'title' => 'URL Shortener API',
            'slug' => 'url-shortener-api',
            'category' => 'other',
            'description' => 'Robust and rate-limited REST API designed to redirect handles with built-in analytics counters.',
            'long_description' => 'Microservice hosting rate-limited redirection endpoints. Integrates Redis caching to redirect custom URL links in under 5ms, logs click metrics.',
            'is_featured' => false,
            'status' => 'COMPLETED',
            'tech_stack' => ['Plain PHP MVC', 'Redis', 'MySQL'],
            'demo_url' => null,
            'github_url' => null,
            'image_path' => 'assets/images/portfolio-placeholder.svg',
            'sort_order' => 10,
        ]);
    }
}
