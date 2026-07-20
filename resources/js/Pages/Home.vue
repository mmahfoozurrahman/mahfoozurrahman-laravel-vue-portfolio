<template>
    <Head title="Mahfoozur Rahman | Full-Stack Laravel Developer">
        <meta name="description" :content="settings.meta_description || 'Personal portfolio of Mahfoozur Rahman, a self-taught Full-Stack Laravel Developer with ~10 years experience. Specialized in Laravel, Vue 3, Inertia.js, and hybrid AI integrations.'" />
    </Head>
    <AppLayout>
        <!-- Hero Section -->
        <section class="hero-section d-flex align-items-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8" data-aos="fade-up">
                        <!-- Dynamic Location Badge -->
                        <div class="location-badge">
                            <span class="location-dot"></span>
                            <span class="font-mono text-secondary">
                                {{ settings.location || 'Dhaka, Bangladesh' }} · Remote-Ready · Japan-Bound
                            </span>
                        </div>

                        <h1 class="display-3 mb-2 text-gradient">
                            {{ settings.owner_name || 'Mahfoozur Rahman' }}
                        </h1>
                        <h2 class="h3 font-mono text-accent mb-4">
                            {{ settings.owner_role || 'Full-Stack Laravel Developer' }}
                        </h2>

                        <p class="lead text-secondary mb-5" style="max-width: 650px;">
                            {{ settings.owner_bio || 'A self-taught full-stack web developer with nearly a decade of experience shipping secure SaaS products.' }}
                        </p>

                        <div class="d-flex flex-wrap gap-3">
                            <a href="/portfolio" class="btn btn-custom btn-custom-primary">
                                <i class="fa-solid fa-briefcase me-2"></i>See My Work
                            </a>
                            <a href="/contact" class="btn btn-custom btn-custom-outline">
                                <i class="fa-solid fa-envelope me-2"></i>Contact Me
                            </a>
                        </div>

                        <!-- Animated Tech Stack Tags -->
                        <div class="tech-icon-container">
                            <div class="tech-icon-item" title="Laravel Framework">
                                <i class="fa-brands fa-laravel"></i><span>Laravel</span>
                            </div>
                            <div class="tech-icon-item" title="Vue.js Frontend">
                                <i class="fa-brands fa-vuejs"></i><span>Vue 3</span>
                            </div>
                            <div class="tech-icon-item" title="Inertia.js Router">
                                <i class="fa-solid fa-link"></i><span>Inertia.js</span>
                            </div>
                            <div class="tech-icon-item" title="MySQL Databases">
                                <i class="fa-solid fa-database"></i><span>MySQL</span>
                            </div>
                            <div class="tech-icon-item" title="Bootstrap 5 Grid">
                                <i class="fa-brands fa-bootstrap"></i><span>Bootstrap 5</span>
                            </div>
                        </div>
                    </div>

                    <!-- Developer Terminal Mockup -->
                    <div class="col-lg-4 d-none d-lg-block" data-aos="fade-left" data-aos-delay="200">
                        <div class="card-custom font-mono" style="padding: 1.5rem; background-color: var(--code-thumb-bg);">
                            <div class="thumb-header">
                                <span class="dot-btn dot-red"></span>
                                <span class="dot-btn dot-yellow"></span>
                                <span class="dot-btn dot-green"></span>
                                <span class="ms-2 text-secondary" style="font-size: 0.75rem;">craftsman.sh</span>
                            </div>
                            <div style="font-size: 0.8rem; color: var(--text-secondary); line-height: 1.5;">
                                <span class="text-accent">$</span> cat developer.json<br>
                                <span class="text-secondary">{</span><br>
                                &nbsp;&nbsp;"name": "{{ settings.owner_name || 'Mahfoozur Rahman' }}",<br>
                                &nbsp;&nbsp;"nickname": "Tusher",<br>
                                &nbsp;&nbsp;"experience": "~10 Years",<br>
                                &nbsp;&nbsp;"philosophy": "Quiet craftsmanship",<br>
                                &nbsp;&nbsp;"relocation": "Tokyo/Osaka, Japan Ready",<br>
                                &nbsp;&nbsp;"status": "open_to_opportunities"<br>
                                <span class="text-secondary">}</span><br>
                                <span class="text-accent">$</span> npm run build:future<br>
                                <span class="text-success">✔ Bundling custom ideas... [100%]</span><br>
                                <span class="text-accent">$</span> <span class="blink">_</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Professional Journey Glimpse -->
        <section class="py-5 border-top border-color bg-secondary">
            <div class="container py-3">
                <div class="row align-items-center">
                    <div class="col-lg-4 mb-4 mb-lg-0" data-aos="fade-right">
                        <span class="font-mono text-accent fs-6">01 / EXPERIENCE</span>
                        <h2 class="h2 display-6 mt-2 mb-3">Professional Journey</h2>
                        <p class="text-secondary mb-4">
                            A decade-long record of shipping enterprise software, API backends, and multi-tenant applications.
                        </p>
                        <a href="/experience" class="btn btn-custom btn-custom-outline btn-custom-sm">
                            Read Full History<i class="fa-solid fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                    <div class="col-lg-8" data-aos="fade-left">
                        <div class="card-custom">
                            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                                <span class="font-mono text-accent">2022 - Present</span>
                                <span class="tech-badge">Remote Work</span>
                            </div>
                            <h3 class="h4 mb-1">Senior Laravel Developer</h3>
                            <p class="text-secondary font-mono mb-3">Core Framework Architect & API Lead</p>
                            <ul class="timeline-list">
                                <li>Design and maintain secure, multi-tenant database architectures in Laravel.</li>
                                <li>Engineer high-performance single-page architectures using Vue 3 and Inertia.js.</li>
                                <li>Pioneered migration of legacy backends to clean domain-driven MVC setups.</li>
                            </ul>
                            <div class="d-flex flex-wrap gap-2 mt-3">
                                <span class="tech-badge">Laravel</span>
                                <span class="tech-badge">Inertia.js</span>
                                <span class="tech-badge">Vue 3</span>
                                <span class="tech-badge">MySQL</span>
                                <span class="tech-badge">Redis</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Selected Projects Glimpse -->
        <section class="py-5 border-top border-color">
            <div class="container py-3">
                <div class="d-flex justify-content-between align-items-end mb-5 flex-wrap gap-3">
                    <div data-aos="fade-right">
                        <span class="font-mono text-accent fs-6">02 / PORTFOLIO</span>
                        <h2 class="h2 display-6 mt-2">Selected Projects</h2>
                    </div>
                    <div data-aos="fade-left">
                        <a href="/portfolio" class="btn btn-custom btn-custom-outline btn-custom-sm">
                            View All Projects<i class="fa-solid fa-arrow-right ms-2"></i>
                        </a>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-custom d-flex flex-column h-100 p-0 overflow-hidden">
                            <div class="portfolio-thumb">
                                <div class="featured-badge"><i class="fa-solid fa-star me-1"></i>FEATURED</div>
                                <div class="thumb-header">
                                    <span class="dot-btn dot-red"></span>
                                    <span class="dot-btn dot-yellow"></span>
                                    <span class="dot-btn dot-green"></span>
                                </div>
                                <div class="thumb-body">
                                    <span class="thumb-title">LILLA SUSHI</span>
                                    <span class="thumb-code">lillasushi.fr</span>
                                </div>
                            </div>
                            <div class="p-4 flex-grow-1 d-flex flex-column">
                                <h3 class="h5 mb-2">Lilla Sushi Restaurant</h3>
                                <p class="text-secondary font-mono small flex-grow-1">
                                    Live online food ordering and management platform deployed in France.
                                </p>
                                <div class="my-3">
                                    <span class="tech-badge">Laravel</span>
                                    <span class="tech-badge">Vue 3</span>
                                    <span class="tech-badge">MySQL</span>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="https://lillasushi.fr" target="_blank" class="btn btn-custom btn-custom-primary btn-custom-sm flex-grow-1">Live Demo</a>
                                    <a href="/portfolio" class="btn btn-custom btn-custom-outline btn-custom-sm"><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-custom d-flex flex-column h-100 p-0 overflow-hidden">
                            <div class="portfolio-thumb">
                                <div class="thumb-header">
                                    <span class="dot-btn dot-red"></span>
                                    <span class="dot-btn dot-yellow"></span>
                                    <span class="dot-btn dot-green"></span>
                                </div>
                                <div class="thumb-body">
                                    <span class="thumb-title">FINANCE SAAS</span>
                                    <span class="thumb-code">multi-tenant.io</span>
                                </div>
                            </div>
                            <div class="p-4 flex-grow-1 d-flex flex-column">
                                <h3 class="h5 mb-2">Loan & Investment SaaS</h3>
                                <p class="text-secondary font-mono small flex-grow-1">
                                    A secure multi-tenant dashboard system designed for custom asset management.
                                </p>
                                <div class="my-3">
                                    <span class="tech-badge">Laravel 10</span>
                                    <span class="tech-badge">Inertia.js</span>
                                    <span class="tech-badge">MySQL</span>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="/portfolio" class="btn btn-custom btn-custom-primary btn-custom-sm flex-grow-1">Live Demo</a>
                                    <a href="/portfolio" class="btn btn-custom btn-custom-outline btn-custom-sm"><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="card-custom d-flex flex-column h-100 p-0 overflow-hidden">
                            <div class="portfolio-thumb">
                                <div class="thumb-header">
                                    <span class="dot-btn dot-red"></span>
                                    <span class="dot-btn dot-yellow"></span>
                                    <span class="dot-btn dot-green"></span>
                                </div>
                                <div class="thumb-body">
                                    <span class="thumb-title">LARACODEVAULT</span>
                                    <span class="thumb-code">laracodevault.com</span>
                                </div>
                            </div>
                            <div class="p-4 flex-grow-1 d-flex flex-column">
                                <h3 class="h5 mb-2">LMS — LaraCodeVault</h3>
                                <p class="text-secondary font-mono small flex-grow-1">
                                    Laravel learning portal and resource repository platform for developers.
                                </p>
                                <div class="my-3">
                                    <span class="tech-badge">Laravel 11</span>
                                    <span class="tech-badge">Livewire</span>
                                    <span class="tech-badge">Tailwind</span>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="https://laracodevault.com" target="_blank" class="btn btn-custom btn-custom-primary btn-custom-sm flex-grow-1">Live Demo</a>
                                    <a href="/portfolio" class="btn btn-custom btn-custom-outline btn-custom-sm"><i class="fa-solid fa-circle-info"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- GitHub Projects Glimpse Section -->
        <section class="py-5 border-top border-color bg-secondary">
            <div class="container py-3">
                <div class="d-flex justify-content-between align-items-end mb-5 flex-wrap gap-3">
                    <div data-aos="fade-right">
                        <span class="font-mono text-accent fs-6">03 / OPEN SOURCE</span>
                        <h2 class="h2 display-6 mt-2">GitHub Repositories</h2>
                    </div>
                    <div data-aos="fade-left">
                        <a href="/github" class="btn btn-custom btn-custom-outline btn-custom-sm">View Repos Grid<i class="fa-solid fa-arrow-right ms-2"></i></a>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="github-repo-card">
                            <div class="repo-header">
                                <h3 class="repo-name"><a href="/github"><i class="fa-brands fa-github me-2"></i>AI-Coding-Assistant-SaaS</a></h3>
                                <span class="tech-badge">Active</span>
                            </div>
                            <p class="repo-desc">A highly optimized Claude API + Groq hybrid router core. Seamless routing between models for maximum code analysis efficiency.</p>
                            <div class="repo-meta">
                                <span><span class="lang-dot lang-php"></span>PHP</span>
                                <span><i class="fa-regular fa-star me-1"></i>34</span>
                                <span><i class="fa-solid fa-code-fork me-1"></i>12</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="github-repo-card">
                            <div class="repo-header">
                                <h3 class="repo-name"><a href="/github"><i class="fa-brands fa-github me-2"></i>librasys</a></h3>
                                <span class="tech-badge">Complete</span>
                            </div>
                            <p class="repo-desc">A modern digital library system utilizing Laravel 11, Inertia.js, and Vue 3 to manage complex digital lending schedules.</p>
                            <div class="repo-meta">
                                <span><span class="lang-dot lang-vue"></span>Vue</span>
                                <span><i class="fa-regular fa-star me-1"></i>21</span>
                                <span><i class="fa-solid fa-code-fork me-1"></i>4</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Glimpse Section -->
        <section class="py-5 border-top border-color">
            <div class="container py-3">
                <div class="card-custom" data-aos="zoom-in" style="background: linear-gradient(135deg, var(--bg-secondary) 50%, rgba(0, 191, 166, 0.03) 100%);">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-8 mb-4 mb-lg-0 text-center text-lg-start">
                            <span class="font-mono text-accent fs-6">04 / CONNECT</span>
                            <h2 class="h2 display-6 mt-2 mb-3">Have a project in mind?</h2>
                            <p class="text-secondary mb-0" style="max-width: 600px;">
                                Currently open to remote full-stack roles, custom contract development, and direct relocation opportunities in Tokyo or Osaka, Japan.
                            </p>
                        </div>
                        <div class="col-lg-4 text-center text-lg-end">
                            <a href="/contact" class="btn btn-custom btn-custom-primary"><i class="fa-solid fa-paper-plane me-2"></i>Get In Touch</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '../Layouts/AppLayout.vue';

defineProps({
    settings: Object,
});
</script>
