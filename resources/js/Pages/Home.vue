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
                                {{ settings.location || 'Dhaka, Bangladesh' }} · Remote-Ready
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
                                    <img :src="avatarUrl" :alt="(settings.owner_name || 'Mahfoozur Rahman')" class="hero-visual-image" />
                                    <div class="hero-photo-overlay" aria-hidden="true"></div>
                                </div>

                                <!-- Skill pills positioned around the ring -->
                                <button v-for="(skill, index) in heroSkills" :key="skill" class="skill-pill" :class="`p${index + 1}`" type="button">{{ skill }}</button>

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
                    <div v-if="experience" class="col-lg-8" data-aos="fade-left">
                        <div class="card-custom">
                            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                                <span class="font-mono text-accent">{{ experience.start_date }} - {{ experience.end_date }}</span>
                                <span v-if="experience.location" class="tech-badge">{{ experience.location }}</span>
                            </div>
                            <h3 class="h4 mb-1">{{ experience.role_title }}</h3>
                            <p class="text-secondary font-mono mb-3">{{ experience.company }}</p>
                            <ul class="timeline-list">
                                <li v-for="accomplishment in experience.accomplishments" :key="accomplishment">{{ accomplishment }}</li>
                            </ul>
                            <div class="d-flex flex-wrap gap-2 mt-3">
                                <span v-for="skill in experience.skills" :key="skill" class="tech-badge">{{ skill }}</span>
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
                    <div v-for="(project, index) in projects" :key="project.id" class="col-md-6 col-lg-4" data-aos="fade-up" :data-aos-delay="(index + 1) * 100">
                        <div class="card-custom d-flex flex-column h-100 p-0 overflow-hidden">
                            <div class="portfolio-thumb">
                                <div v-if="project.is_featured" class="featured-badge"><i class="fa-solid fa-star me-1"></i>FEATURED</div>
                                <div class="thumb-header"><span class="dot-btn dot-red"></span><span class="dot-btn dot-yellow"></span><span class="dot-btn dot-green"></span></div>
                                <div v-if="project.image_path" class="selected-project-image">
                                    <img :src="`/${project.image_path}`" :alt="project.title" loading="lazy">
                                </div>
                                <div v-else class="thumb-body"><span class="thumb-title">{{ project.title }}</span><span class="thumb-code">{{ project.demo_url || project.slug }}</span></div>
                            </div>
                            <div class="p-4 flex-grow-1 d-flex flex-column">
                                <h3 class="h5 mb-2">{{ project.title }}</h3>
                                <p class="text-secondary font-mono small flex-grow-1">{{ project.description }}</p>
                                <div class="my-3"><span v-for="tech in project.tech_stack" :key="tech" class="tech-badge">{{ tech }}</span></div>
                                <div class="d-flex gap-2"><a v-if="project.demo_url" :href="project.demo_url" target="_blank" rel="noopener" class="btn btn-custom btn-custom-primary btn-custom-sm flex-grow-1">Live Demo</a><a v-else href="/portfolio" class="btn btn-custom btn-custom-primary btn-custom-sm flex-grow-1">View Project</a><a href="/portfolio" :aria-label="`View ${project.title} details`" class="btn btn-custom btn-custom-outline btn-custom-sm"><i class="fa-solid fa-circle-info"></i></a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- GitHub Projects Glimpse Section -->
        <section v-if="repos.length" class="py-5 border-top border-color bg-secondary">
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
                    <div v-for="(repo, index) in repos" :key="repo.id" class="col-md-6" data-aos="fade-up" :data-aos-delay="(index + 1) * 100">
                        <div class="github-repo-card">
                            <div class="repo-header">
                                <h3 class="repo-name"><a :href="repo.repo_url" target="_blank" rel="noopener"><i class="fa-brands fa-github me-2"></i>{{ repo.name }}</a></h3>
                                <span class="tech-badge">Public</span>
                            </div>
                            <p class="repo-desc">{{ repo.description || 'No description provided for this repository.' }}</p>
                            <div class="repo-meta">
                                <span><span class="lang-dot lang-php"></span>{{ repo.language || 'Unknown' }}</span>
                                <span><i class="fa-regular fa-star me-1"></i>{{ repo.stars_count }}</span>
                                <span><i class="fa-solid fa-code-fork me-1"></i>{{ repo.forks_count }}</span>
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
                                {{ settings.relocation_notice || 'Currently open to remote full-stack roles, custom contract development, and direct relocation opportunities in Tokyo or Osaka, Japan.' }}
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
import { computed } from 'vue';
import { Head } from '@inertiajs/vue3';
import AppLayout from '../Layouts/AppLayout.vue';

const props = defineProps({
    settings: Object,
    experience: Object,
    projects: { type: Array, default: () => [] },
    repos: { type: Array, default: () => [] },
});

const avatarUrl = computed(() => `/${props.settings?.owner_avatar || 'img/myself.jpg'}`);
const heroSkills = computed(() => (props.experience?.skills || ['Laravel', 'Vue 3', 'Inertia.js', 'MySQL', 'Bootstrap 5', 'AI Native']).slice(0, 6));
</script>

<style scoped>
.hero-stack-note {
    display: inline-flex;
    margin-top: 2rem;
    color: rgba(255, 213, 158, 0.72);
    font-size: 0.86rem;
}

.selected-project-image {
    height: 150px;
    overflow: hidden;
    border-radius: 0 0 4px 4px;
}

.selected-project-image img {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover;
    transition: transform 0.35s ease;
}

.card-custom:hover .selected-project-image img {
    transform: scale(1.04);
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
