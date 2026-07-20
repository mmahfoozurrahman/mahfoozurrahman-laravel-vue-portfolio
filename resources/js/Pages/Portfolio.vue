<template>
    <Head title="Portfolio">
        <meta name="description" content="Explore the full-stack web applications and SaaS tools built by Mahfoozur Rahman. Filterable project grid showcasing Laravel, Vue 3, and MySQL craftsmanship." />
    </Head>
    <AppLayout>
        <!-- Page Header -->
        <header class="page-header text-center">
            <div class="container" data-aos="fade-down">
                <span class="font-mono text-accent fs-6">PROJECTS ARCHIVE</span>
                <h1 class="display-4 mt-2 mb-3">Portfolio</h1>
                <p class="text-secondary mx-auto" style="max-width: 600px;">
                    A curated showcase of production-ready SaaS platforms, vertical CRM/POS products, and developer tools built with clean architectures.
                </p>
            </div>
        </header>

        <!-- Dynamic Projects Grid -->
        <section class="py-5">
            <div class="container py-3">
                <!-- Interactive Category Filter Pills -->
                <div class="d-flex justify-content-center flex-wrap gap-2 mb-5" data-aos="fade-up">
                    <button v-for="cat in categories" :key="cat.value"
                        @click="activeCategory = cat.value"
                        class="filter-btn"
                        :class="{ 'active': activeCategory === cat.value }">
                        {{ cat.label }}
                    </button>
                </div>

                <!-- Projects Loops Grid -->
                <div class="row g-4 portfolio-grid">
                    <div
                        v-for="(proj, index) in filteredProjects"
                        :key="proj.id"
                        class="col-lg-4 col-md-6 portfolio-item"
                        :data-category="proj.category"
                        data-aos="fade-up"
                        :data-aos-delay="(index + 1) * 50"
                    >
                        <div class="card-custom d-flex flex-column h-100 p-0 overflow-hidden">
                            <div class="portfolio-thumb">
                                <div v-if="proj.is_featured" class="featured-badge">
                                    <i class="fa-solid fa-star me-1"></i>FEATURED
                                </div>
                                <div v-else-if="proj.status?.toLowerCase() === 'building'" class="featured-badge" style="background-color: #ff9f1c;">
                                    <i class="fa-solid fa-screwdriver-wrench me-1"></i>BUILDING
                                </div>
                                <div class="thumb-header">
                                    <span class="dot-btn dot-red"></span>
                                    <span class="dot-btn dot-yellow"></span>
                                    <span class="dot-btn dot-green"></span>
                                </div>
                                <div class="thumb-image-wrapper flex-grow-1 overflow-hidden position-relative" style="border-radius: 4px;">
                                    <img :src="'/' + (proj.image_path || 'assets/images/portfolio-placeholder.svg')"
                                        :alt="proj.title" class="w-100 h-100 object-fit-cover">
                                </div>
                            </div>

                            <!-- Card Body details -->
                            <div class="p-4 flex-grow-1 d-flex flex-column">
                                <h3 class="h5 mb-2">{{ proj.title }}</h3>
                                <p class="text-secondary font-mono small flex-grow-1">
                                    {{ proj.description }}
                                </p>

                                <!-- Tech Stack Tag Row -->
                                <div class="my-3 tech-tags">
                                    <span v-for="(tag, tIdx) in proj.tech_stack" :key="tIdx" class="tech-badge">
                                        {{ tag }}
                                    </span>
                                </div>

                                <!-- Actions trigger -->
                                <div class="d-flex gap-2">
                                    <a v-if="proj.demo_url" :href="proj.demo_url" target="_blank"
                                        class="btn btn-custom btn-custom-primary btn-custom-sm flex-grow-1">
                                        Live Demo
                                    </a>
                                    <button v-else class="btn btn-custom btn-custom-primary btn-custom-sm flex-grow-1" disabled>Live Demo</button>
                                    <button @click="openDetails(proj)" class="btn btn-custom btn-custom-outline btn-custom-sm">Details</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Empty results notice -->
                    <div v-if="filteredProjects.length === 0" class="col-12 text-center py-5">
                        <i class="fa-solid fa-folder-open text-muted display-4 mb-3"></i>
                        <h4 class="text-secondary">No projects found in this category</h4>
                    </div>
                </div>
            </div>
        </section>

        <!-- Dynamic Premium details Overlay Modal -->
        <div v-if="selectedProject" class="modal-overlay" @click.self="closeDetails">
            <div class="modal-card card-custom p-0 overflow-hidden" data-aos="zoom-in" data-aos-duration="300">
                <div class="portfolio-thumb">
                    <div class="thumb-header d-flex justify-content-between align-items-center">
                        <div>
                            <span class="dot-btn dot-red" @click="closeDetails"></span>
                            <span class="dot-btn dot-yellow"></span>
                            <span class="dot-btn dot-green"></span>
                        </div>
                        <button @click="closeDetails" class="btn-modal-close" aria-label="Close Modal">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="modal-thumb-title-wrapper text-center py-4">
                        <h2 class="display-6 text-gradient mb-0">{{ selectedProject.title }}</h2>
                        <span class="text-accent font-mono text-xs">{{ selectedProject.demo_url || selectedProject.slug }}</span>
                    </div>
                </div>

                <div class="p-4">
                    <div class="row g-4">
                        <div class="col-md-7">
                            <h4 class="h5 text-white mb-2 font-sans"><i class="fa-solid fa-paragraph text-accent me-2"></i>Overview</h4>
                            <p class="text-secondary small font-mono line-height-lg">
                                {{ selectedProject.long_description || selectedProject.description }}
                            </p>
                        </div>
                        <div class="col-md-5 border-start-md border-color">
                            <div class="d-flex flex-column gap-3">
                                <div>
                                    <h5 class="text-white text-xs font-mono fw-bold mb-1"><i class="fa-solid fa-layer-group text-accent me-2"></i>CATEGORY</h5>
                                    <span class="badge badge-relocation px-3 text-uppercase font-sans">{{ selectedProject.category }}</span>
                                </div>
                                <div>
                                    <h5 class="text-white text-xs font-mono fw-bold mb-1"><i class="fa-solid fa-list-check text-accent me-2"></i>STATUS</h5>
                                    <span class="status-indicator-pill" :class="selectedProject.status.toLowerCase()">
                                        <span class="status-dot"></span>{{ selectedProject.status }}
                                    </span>
                                </div>
                                <div>
                                    <h5 class="text-white text-xs font-mono fw-bold mb-2"><i class="fa-solid fa-gears text-accent me-2"></i>TECH STACK</h5>
                                    <div class="d-flex flex-wrap gap-1">
                                        <span v-for="(tag, idx) in selectedProject.tech_stack" :key="idx" class="tech-badge text-xxs">
                                            {{ tag }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Actions Button Footer -->
                    <div class="border-top border-color mt-4 pt-3 d-flex justify-content-end gap-2">
                        <a v-if="selectedProject.github_url" :href="selectedProject.github_url" target="_blank"
                            class="btn btn-custom btn-custom-outline btn-custom-xs px-3">
                            <i class="fa-brands fa-github me-1"></i>View Code
                        </a>
                        <a v-if="selectedProject.demo_url" :href="selectedProject.demo_url" target="_blank"
                            class="btn btn-custom btn-custom-primary btn-custom-xs px-3">
                            <i class="fa-solid fa-arrow-up-right-from-square me-1"></i>Live Demo
                        </a>
                        <button @click="closeDetails" class="btn btn-custom btn-custom-outline btn-custom-xs px-3">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Head } from '@inertiajs/vue3';
import AppLayout from '../Layouts/AppLayout.vue';

const props = defineProps({
    settings: Object,
    projects: Array,
});

const activeCategory = ref('all');
const selectedProject = ref(null);

const categories = [
    { label: 'All', value: 'all' },
    { label: 'SaaS', value: 'saas' },
    { label: 'LMS', value: 'lms' },
    { label: 'POS', value: 'pos' },
    { label: 'E-commerce', value: 'e-commerce' },
    { label: 'Restaurant', value: 'restaurant' },
    { label: 'Health', value: 'health' },
    { label: 'Other', value: 'other' },
];

const filteredProjects = computed(() => {
    if (activeCategory.value === 'all') {
        return props.projects;
    }
    return props.projects.filter(p => p.category.toLowerCase() === activeCategory.value);
});

function openDetails(proj) {
    selectedProject.value = proj;
    document.body.style.overflow = 'hidden';
}

function closeDetails() {
    selectedProject.value = null;
    document.body.style.overflow = '';
}
</script>

<style scoped>
/* High-Fidelity Modal Styles */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(10, 16, 26, 0.7);
    backdrop-filter: blur(15px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    padding: 1.5rem;
}

.modal-card {
    width: 100%;
    max-width: 750px;
    background: var(--bg-secondary, #0f172a);
    border: 1px solid var(--border-color, #1e293b);
    animation: scaleUp 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.btn-modal-close {
    background: transparent;
    border: none;
    color: var(--text-muted, #94a3b8);
    font-size: 1.25rem;
    cursor: pointer;
    transition: color 0.2s;
}

.btn-modal-close:hover {
    color: var(--accent-color, #10b981);
}

.border-start-md {
    @media (min-width: 768px) {
        border-left: 1px solid var(--border-color) !important;
    }
}

.line-height-lg {
    line-height: 1.8;
}

@keyframes scaleUp {
    from { transform: scale(0.9); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}
</style>
