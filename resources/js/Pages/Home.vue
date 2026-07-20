<template>
    <Head title="Mahfoozur Rahman | Full-Stack Laravel Developer">
        <meta name="description" :content="settings.meta_description || 'Personal portfolio of Mahfoozur Rahman, a self-taught Full-Stack Laravel Developer with ~10 years experience. Specialized in Laravel, Vue 3, Inertia.js, and hybrid AI integrations.'" />
    </Head>
    <AppLayout>
        <!-- Hero Section -->
        <section class="hero-section d-flex align-items-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7" data-aos="fade-up">
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

                    <!-- Hero Portrait -->
                    <div class="col-lg-5 d-none d-lg-block" data-aos="fade-left" data-aos-delay="200">
                        <div class="hero-visual-card">
                            <div class="hero-visual-frame" role="img" :aria-label="(settings.owner_name || 'Portrait')">
                                <div class="hero-visual-glow" aria-hidden="true"></div>
                                <div class="hero-ring" aria-hidden="true"></div>

                                <div class="hero-photo-frame">
                                    <img :src="'/img/myself.jpg'" :alt="(settings.owner_name || 'Mahfoozur Rahman')" class="hero-visual-image" />
                                    <div class="hero-photo-overlay" aria-hidden="true"></div>
                                </div>

                                <!-- Skill pills positioned around the ring -->
                                <button class="skill-pill p1" type="button">Laravel</button>
                                <button class="skill-pill p2" type="button">Vue 3</button>
                                <button class="skill-pill p3" type="button">Inertia.js</button>
                                <button class="skill-pill p4" type="button">MySQL</button>
                                <button class="skill-pill p5" type="button">Bootstrap 5</button>
                                <button class="skill-pill p6" type="button">AI Native</button>

                                <div class="experience-badge">
                                    10+<span>Years Exp.</span>
                                </div>
                                <div class="availability-pill"><span></span>Available</div>
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
                    <a href="/portfolio" class="btn btn-custom btn-custom-outline btn-custom-sm" data-aos="fade-left">View All Projects<i class="fa-solid fa-arrow-right ms-2"></i></a>
                </div>

                <div class="row g-4">
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="card-custom d-flex flex-column h-100 p-0 overflow-hidden">
                            <div class="portfolio-thumb">
                                <div class="featured-badge"><i class="fa-solid fa-star me-1"></i>FEATURED</div>
                                <div class="thumb-header"><span class="dot-btn dot-red"></span><span class="dot-btn dot-yellow"></span><span class="dot-btn dot-green"></span></div>
                                <div class="thumb-body"><span class="thumb-title">LILLA SUSHI</span><span class="thumb-code">lillasushi.fr</span></div>
                            </div>
                            <div class="p-4 flex-grow-1 d-flex flex-column">
                                <h3 class="h5 mb-2">Lilla Sushi Restaurant</h3>
                                <p class="text-secondary font-mono small flex-grow-1">Live online food ordering and management platform deployed in France.</p>
                                <div class="my-3"><span class="tech-badge">Laravel</span><span class="tech-badge">Vue 3</span><span class="tech-badge">MySQL</span></div>
                                <div class="d-flex gap-2"><a href="https://lillasushi.fr" target="_blank" rel="noopener" class="btn btn-custom btn-custom-primary btn-custom-sm flex-grow-1">Live Demo</a><a href="/portfolio" aria-label="View Lilla Sushi details" class="btn btn-custom btn-custom-outline btn-custom-sm"><i class="fa-solid fa-circle-info"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="card-custom d-flex flex-column h-100 p-0 overflow-hidden">
                            <div class="portfolio-thumb">
                                <div class="thumb-header"><span class="dot-btn dot-red"></span><span class="dot-btn dot-yellow"></span><span class="dot-btn dot-green"></span></div>
                                <div class="thumb-body"><span class="thumb-title">FINANCE SAAS</span><span class="thumb-code">multi-tenant.io</span></div>
                            </div>
                            <div class="p-4 flex-grow-1 d-flex flex-column">
                                <h3 class="h5 mb-2">Loan &amp; Investment SaaS</h3>
                                <p class="text-secondary font-mono small flex-grow-1">A secure multi-tenant dashboard system designed for custom asset management.</p>
                                <div class="my-3"><span class="tech-badge">Laravel 10</span><span class="tech-badge">Inertia.js</span><span class="tech-badge">MySQL</span></div>
                                <div class="d-flex gap-2"><a href="/portfolio" class="btn btn-custom btn-custom-primary btn-custom-sm flex-grow-1">Live Demo</a><a href="/portfolio" aria-label="View Loan and Investment SaaS details" class="btn btn-custom btn-custom-outline btn-custom-sm"><i class="fa-solid fa-circle-info"></i></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="card-custom d-flex flex-column h-100 p-0 overflow-hidden">
                            <div class="portfolio-thumb">
                                <div class="thumb-header"><span class="dot-btn dot-red"></span><span class="dot-btn dot-yellow"></span><span class="dot-btn dot-green"></span></div>
                                <div class="thumb-body"><span class="thumb-title">LARACODEVAULT</span><span class="thumb-code">laracodevault.com</span></div>
                            </div>
                            <div class="p-4 flex-grow-1 d-flex flex-column">
                                <h3 class="h5 mb-2">LMS - LaraCodeVault</h3>
                                <p class="text-secondary font-mono small flex-grow-1">Laravel learning portal and resource repository platform for developers.</p>
                                <div class="my-3"><span class="tech-badge">Laravel 11</span><span class="tech-badge">Livewire</span><span class="tech-badge">Tailwind</span></div>
                                <div class="d-flex gap-2"><a href="https://laracodevault.com" target="_blank" rel="noopener" class="btn btn-custom btn-custom-primary btn-custom-sm flex-grow-1">Live Demo</a><a href="/portfolio" aria-label="View LaraCodeVault details" class="btn btn-custom btn-custom-outline btn-custom-sm"><i class="fa-solid fa-circle-info"></i></a></div>
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

<style scoped>
.hero-stack-note {
    display: inline-flex;
    margin-top: 2rem;
    color: rgba(255, 213, 158, 0.72);
    font-size: 0.86rem;
}

/* Hero visual: template-inspired portrait frame + floating skill pills */
.hero-visual-card {
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 520px;
    padding: 2rem 0;
}

.hero-visual-glow {
    position: absolute;
    inset: 13% 9% 4% 3%;
    border-radius: 52% 48% 44% 56% / 48% 52% 48% 52%;
    background:
        radial-gradient(circle at 44% 42%, rgba(235, 111, 31, 0.32), transparent 34%),
        radial-gradient(circle at 75% 68%, rgba(242, 161, 27, 0.22), transparent 42%);
    filter: blur(34px);
    opacity: 0.78;
    pointer-events: none;
    z-index: 0;
}

.hero-visual-frame {
    position: relative;
    width: min(100%, 520px);
    height: 500px;
    z-index: 1;
    display: flex;
    align-items: center;
    justify-content: center;
}

.hero-ring {
    position: absolute;
    width: 390px;
    height: 470px;
    border-radius: 40% 60% 55% 45% / 45% 45% 55% 55%;
    border: 1.5px dashed rgba(255, 186, 71, 0.52);
    transform: rotate(-7deg);
    pointer-events: none;
    z-index: 1;
}

.hero-photo-frame {
    position: relative;
    width: 300px;
    height: 390px;
    overflow: hidden;
    border-radius: 52% 48% 44% 56% / 48% 52% 48% 52%;
    border: 2px solid rgba(242, 161, 27, 0.42);
    box-shadow:
        0 0 0 5px rgba(80, 27, 8, 0.36),
        0 22px 58px rgba(80, 21, 5, 0.36),
        inset 0 0 42px rgba(0, 0, 0, 0.28);
    animation: morphShape 8s ease-in-out infinite alternate;
    z-index: 2;
}

.hero-visual-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center top;
    display: block;
    filter: contrast(1.05) saturate(0.94);
    transition: transform 560ms cubic-bezier(.22,.9,.33,1);
    transform-origin: center center;
    will-change: transform;
}

.hero-visual-card:hover .hero-visual-image {
    transform: scale(1.04);
}

.hero-photo-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(30, 8, 2, 0.58) 0%, rgba(30, 8, 2, 0.14) 40%, transparent 72%);
    pointer-events: none;
}

/* Skill pills */
.skill-pill {
    position: absolute;
    min-width: 92px;
    padding: 0.52rem 1.05rem;
    border-radius: 999px;
    background: var(--accent-primary);
    color: #ffffff;
    border: 1px solid rgba(255, 232, 200, 0.32);
    font-size: 0.78rem;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    box-shadow:
        0 10px 24px var(--accent-glow),
        inset 0 1px 0 rgba(255, 245, 220, 0.35);
    cursor: default;
    transform-origin: center;
    animation: skillLift 3.8s ease-in-out infinite;
    z-index: 3;
}

.skill-pill.p1 { top: 18%; left: 6%; animation-delay: 0s; }
.skill-pill.p2 { top: 14%; right: 12%; animation-delay: 0.18s; }
.skill-pill.p3 { right: 0; top: 45%; animation-delay: 0.36s; }
.skill-pill.p4 { bottom: 23%; left: 7%; animation-delay: 0.54s; }
.skill-pill.p5 { bottom: 14%; right: 8%; min-width: 122px; animation-delay: 0.72s; }
.skill-pill.p6 { left: 0; top: 45%; min-width: 112px; animation-delay: 0.9s; }

.experience-badge {
    position: absolute;
    left: 44%;
    bottom: 3%;
    padding: 0.9rem 1.08rem;
    border-radius: 18px;
    background: linear-gradient(135deg, #f2a11b, #ffd195);
    color: #311005;
    font-family: Georgia, 'Times New Roman', serif;
    font-size: 1.45rem;
    font-weight: 800;
    line-height: 1.05;
    text-align: center;
    box-shadow: 0 12px 30px rgba(242, 161, 27, 0.34), 0 8px 18px rgba(30, 8, 2, 0.36);
    transform: translateX(-50%);
    z-index: 4;
}

.experience-badge span {
    display: block;
    margin-top: 0.12rem;
    font-family: inherit;
    font-size: 0.72rem;
    font-weight: 700;
}

.availability-pill {
    position: absolute;
    top: 5%;
    left: 50%;
    display: inline-flex;
    align-items: center;
    gap: 0.46rem;
    min-width: 132px;
    justify-content: center;
    padding: 0.52rem 1.05rem;
    border-radius: 999px;
    background: var(--accent-primary);
    color: #ffffff;
    border: 1px solid rgba(255, 232, 200, 0.32);
    box-shadow:
        0 10px 24px var(--accent-glow),
        inset 0 1px 0 rgba(255, 245, 220, 0.35);
    font-size: 0.78rem;
    font-weight: 700;
    line-height: 1;
    letter-spacing: 0;
    transform: translateX(-50%);
    animation: centeredSkillLift 3.8s ease-in-out infinite;
    z-index: 4;
}

.availability-pill span {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #4ade80;
    animation: availabilityPulse 2s ease-in-out infinite;
}

@keyframes morphShape {
    0% { border-radius: 52% 48% 44% 56% / 48% 52% 48% 52%; }
    100% { border-radius: 48% 52% 56% 44% / 52% 48% 52% 48%; }
}

@keyframes skillLift {
    0% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0); }
}

@keyframes centeredSkillLift {
    0% { transform: translateX(-50%) translateY(0); }
    50% { transform: translateX(-50%) translateY(-10px); }
    100% { transform: translateX(-50%) translateY(0); }
}

@keyframes availabilityPulse {
    0%, 100% {
        opacity: 1;
        box-shadow: 0 0 0 0 rgba(74, 222, 128, 0.45);
    }
    50% {
        opacity: 0.68;
        box-shadow: 0 0 0 7px rgba(74, 222, 128, 0);
    }
}

@media (max-width: 1199px) {
    .hero-visual-card { min-height: 450px; }
    .hero-visual-frame { height: 430px; }
    .hero-ring { width: 330px; height: 400px; }
    .hero-photo-frame { width: 248px; height: 328px; }
    .skill-pill { min-width: 82px; padding: 0.48rem 0.86rem; font-size: 0.72rem; }
    .skill-pill.p5 { min-width: 110px; }
    .skill-pill.p6 { min-width: 100px; }
    .experience-badge { bottom: 1%; }
}

@media (prefers-reduced-motion: reduce) {
    .skill-pill, .hero-photo-frame, .hero-visual-image, .availability-pill, .availability-pill span { animation: none !important; transition: none !important; }
}

</style>
