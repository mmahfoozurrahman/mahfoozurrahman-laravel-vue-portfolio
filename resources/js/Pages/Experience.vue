<template>
    <Head title="Work Experience">
        <meta name="description" content="Professional history and work timeline of Mahfoozur Rahman. Over 10 years of experience in Laravel, CakePHP, Vue.js, and SQL backend engineering." />
    </Head>
    <AppLayout>
        <!-- Experience Hero Page Header -->
        <header class="page-header text-center">
            <div class="container" data-aos="fade-down">
                <span class="font-mono text-accent fs-6">CAREER TIMELINE</span>
                <h1 class="display-4 mt-2 mb-3">Work Experience</h1>
                <p class="text-secondary mx-auto" style="max-width: 600px;">
                    A decade-long journey of self-taught web craftsmanship, moving from pixel-perfect templates to massive multi-tenant systems.
                </p>
            </div>
        </header>

        <!-- Chronological Timeline Loop -->
        <section class="py-5">
            <div class="container py-3">
                <div class="timeline-wrapper">
                    <!-- Dynamic Timeline Entries Loop -->
                    <div v-for="(exp, idx) in experiences" :key="exp.id"
                        class="timeline-item"
                        :class="idx % 2 === 0 ? 'timeline-item-right' : 'timeline-item-left'"
                        data-aos="fade-up">
                        
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <div class="timeline-card" :style="exp.is_featured ? 'border-color: var(--accent-primary); box-shadow: 0 8px 30px var(--accent-glow);' : ''">
                                <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-2">
                                    <span class="timeline-date font-mono">
                                        <i class="fa-regular me-2" :class="exp.is_featured ? 'fa-calendar-check' : 'fa-calendar'"></i>{{ exp.start_date }} - {{ exp.end_date }}
                                    </span>
                                    <span v-if="exp.is_featured" class="tech-badge" style="border-color: var(--accent-primary); color: var(--accent-primary);">
                                        Featured Role
                                    </span>
                                </div>

                                <h3 class="timeline-title">{{ exp.role_title }}</h3>
                                <h4 class="timeline-company" :class="{ 'text-accent': exp.is_featured }">
                                    <i class="fa-solid me-2" :class="exp.is_featured ? 'fa-laptop-code' : 'fa-building'"></i>{{ exp.company }}
                                    <span v-if="exp.location && exp.location !== exp.company && exp.location !== 'Remote'"> — {{ exp.location }}</span>
                                </h4>

                                <!-- Split Grid Info Panel -->
                                <div class="row g-4 mt-2 align-items-center">
                                    <!-- Image Vector container -->
                                    <div class="col-md-4">
                                        <div class="experience-img-container rounded overflow-hidden" style="border: 1px solid var(--border-color); height: 160px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                                            <img :src="'/' + (exp.image_path || 'assets/images/experience-placeholder.svg')"
                                                :alt="exp.role_title"
                                                class="w-100 h-100 object-fit-cover">
                                        </div>
                                    </div>
                                    <!-- Accomplishments Bullet Points list -->
                                    <div class="col-md-8">
                                        <ul class="timeline-list m-0">
                                            <li v-for="(bullet, bIdx) in exp.accomplishments" :key="bIdx">
                                                {{ bullet }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Skill Badges Row -->
                                <div class="d-flex flex-wrap gap-2 tech-badge-row">
                                    <span v-for="(skill, sIdx) in exp.skills" :key="sIdx" class="tech-badge">
                                        {{ skill }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mt-5" data-aos="zoom-in">
                    <div class="col-lg-8">
                        <div class="alert-custom">
                            <div class="alert-custom-icon">
                                <i class="fa-solid fa-circle-info"></i>
                            </div>
                            <div>
                                <strong class="text-gradient">Verification Disclaimer:</strong>
                                <p class="mb-0 text-secondary mt-1">
                                    Employment proof or certificates are unavailable for some legacy roles due to past local company closures. My extensive GitHub repositories, SaaS products, and active client deployments serve as live proof of work and code craftsmanship.
                                </p>
                            </div>
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
    experiences: Array,
});
</script>
