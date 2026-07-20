<template>
    <Head title="GitHub Projects">
        <meta name="description" content="Explore Mahfoozur Rahman's open source contributions and active repositories on GitHub. Laravel backends, database plugins, and single-page apps." />
    </Head>

    <AppLayout>
        <header class="page-header text-center">
            <div class="container" data-aos="fade-down">
                <span class="font-mono text-accent fs-6">OPEN SOURCE SCRIPTS</span>
                <h1 class="display-4 mt-2 mb-3">GitHub Projects</h1>
                <p class="text-secondary mx-auto" style="max-width: 600px;">
                    Exploring my public code repositories, utility scripts, and system integrations. These projects highlight coding craftsmanship and API-driven design.
                </p>
            </div>
        </header>

        <section class="py-5">
            <div class="container py-3">
                <div class="row justify-content-center mb-5" data-aos="fade-up">
                    <div class="col-lg-10">
                        <div class="card-custom font-mono" style="padding: 1rem 1.5rem; background-color: var(--code-thumb-bg); border-style: dashed;">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-accent" style="font-size: 0.85rem;">
                                    <i class="fa-solid fa-circle-nodes me-2"></i>{{ apiEndpoint }}
                                </span>
                                <span class="text-secondary" style="font-size: 0.75rem;">Status: <span class="text-success">200 OK</span></span>
                            </div>
                            <p class="mb-0 text-secondary" style="font-size: 0.8rem; line-height: 1.4;">
                                <span class="text-accent">[API Info]</span> The repository grid below is populated from GitHub data cached by Laravel, including repository statistics, star counts, and fork counts to avoid API rate limits.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div
                        v-for="(repo, index) in displayedRepos"
                        :key="repo.id || repo.name"
                        class="col-lg-4 col-md-6"
                        data-aos="fade-up"
                        :data-aos-delay="(index + 1) * 50"
                    >
                        <div class="github-repo-card">
                            <div class="repo-header">
                                <h3 class="repo-name">
                                    <a :href="repo.repo_url || githubProfile" target="_blank">
                                        <i class="fa-brands fa-github me-2"></i>{{ repo.name }}
                                    </a>
                                </h3>
                                <span class="tech-badge font-mono">Public</span>
                            </div>
                            <p class="repo-desc">{{ repo.description || 'No description provided for this repository.' }}</p>
                            <div class="repo-meta mt-auto">
                                <span><span class="lang-dot" :class="`lang-${getLangClass(repo.language)}`"></span>{{ repo.language || 'PHP' }}</span>
                                <span><i class="fa-regular fa-star me-1"></i>{{ repo.stars_count ?? 0 }}</span>
                                <span><i class="fa-solid fa-code-fork me-1"></i>{{ repo.forks_count ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-5 pt-3" data-aos="zoom-in">
                    <div class="col text-center">
                        <a :href="githubProfile" target="_blank" class="btn btn-custom btn-custom-primary">
                            <i class="fa-brands fa-github me-2"></i>View Full GitHub Profile
                        </a>
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
    repos: Array,
});

const mockRepos = [
    { name: 'loan-investment-saas', description: 'Core engine and multi-tenant ledger for financial investment tools. Includes double-entry accounting models and robust multi-tenant middleware systems.', language: 'PHP', stars_count: 42, forks_count: 14 },
    { name: 'laracodevault-lms', description: 'Laravel portal and code snippet repository system. Interactive dashboard with progress marks and rich dynamic video courses handling.', language: 'PHP', stars_count: 56, forks_count: 18 },
    { name: 'isp-billing-tracker', description: 'Subscription tracker and invoicing application optimized for ISP service management. Automates monthly invoice emails and subscriber notifications.', language: 'PHP', stars_count: 28, forks_count: 9 },
    { name: 'lilla-sushi-app', description: 'Food delivery dashboard and dynamic POS checkout interface deployed in France. Integrates real-time delivery routing and checkout.', language: 'PHP', stars_count: 89, forks_count: 31 },
    { name: 'librasys-engine', description: 'Inertia.js and Vue 3 client application coupled with Laravel 11. Handles catalogs indexing, digital lending pipelines, and user notifications.', language: 'Vue', stars_count: 31, forks_count: 6 },
    { name: 'url-shortener-rest-api', description: 'RESTful url shortener API using plain PHP MVC design. Rate limit headers integrated via custom server-side middleware and Redis.', language: 'JavaScript', stars_count: 19, forks_count: 5 },
];

const githubProfile = computed(() => props.settings?.github_url || 'https://github.com/mmrahman');
const githubUsername = computed(() => githubProfile.value.replace(/\/$/, '').split('/').pop() || 'mmrahman');
const apiEndpoint = computed(() => `api.github.com/users/${githubUsername.value}/repos`);
const displayedRepos = computed(() => props.repos?.length ? props.repos : mockRepos);

function getLangClass(language) {
    const lang = (language || '').toLowerCase();
    if (lang.includes('vue')) return 'vue';
    if (lang.includes('js') || lang.includes('javascript')) return 'js';
    return 'php';
}
</script>
