<template>
    <footer class="py-5 mt-auto border-top border-color bg-secondary">
        <div class="container">
            <div class="row g-4 mb-4 text-start">
                <!-- Column 1: Short Bio & Status -->
                <div class="col-lg-4 col-md-6">
                    <h5 class="h6 font-mono text-accent mb-3">
                        <i class="fa-solid fa-terminal me-2"></i>Mahfoozur<span>.dev</span>
                    </h5>
                    <p class="text-secondary small mb-3">
                        {{ settings.owner_bio ? truncateText(settings.owner_bio, 180) : 'A dedicated full-stack craftsman engineering robust Laravel + Vue 3 systems. Nearly 10 years of self-taught experience shipping premium web applications.' }}
                    </p>
                    <div class="d-flex align-items-center gap-2">
                        <span class="location-dot" style="width: 8px; height: 8px;"></span>
                        <span class="font-mono text-secondary" style="font-size: 0.75rem;">
                            Status: Available for Remote & Japan Relocation
                        </span>
                    </div>
                </div>

                <!-- Column 2: Navigation Links -->
                <div class="col-lg-2 col-md-6 col-6">
                    <h5 class="h6 font-mono text-accent mb-3">Navigation</h5>
                    <ul class="list-unstyled mb-0 font-mono" style="font-size: 0.85rem;">
                        <li class="mb-2"><a href="/" class="text-secondary hover-accent">Home</a></li>
                        <li class="mb-2"><a href="/experience" class="text-secondary hover-accent">Experience</a></li>
                        <li class="mb-2"><a href="/portfolio" class="text-secondary hover-accent">Portfolio</a></li>
                        <li class="mb-2"><a href="/github" class="text-secondary hover-accent">GitHub</a></li>
                        <li class="mb-2"><a href="/contact" class="text-secondary hover-accent">Contact</a></li>
                    </ul>
                </div>

                <!-- Column 3: Primary Stack -->
                <div class="col-lg-3 col-md-6 col-6">
                    <h5 class="h6 font-mono text-accent mb-3">Primary Stack</h5>
                    <ul class="list-unstyled mb-0 font-mono text-secondary" style="font-size: 0.85rem;">
                        <li class="mb-2"><i class="fa-brands fa-laravel text-accent me-2"></i>Laravel Core</li>
                        <li class="mb-2"><i class="fa-brands fa-vuejs text-accent me-2"></i>Vue 3 & Inertia</li>
                        <li class="mb-2"><i class="fa-solid fa-database text-accent me-2"></i>MySQL & Redis</li>
                        <li class="mb-2"><i class="fa-solid fa-microchip text-accent me-2"></i>AI Hybrid SaaS</li>
                    </ul>
                </div>

                <!-- Column 4: Contact & Inquiries -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="h6 font-mono text-accent mb-3">Location</h5>
                    <p class="text-secondary small mb-3">
                        {{ settings.location || 'Dhaka, Bangladesh' }}<br>
                        {{ settings.relocation_notice || 'Open to Remote & Japan Relocation (Engineer Visa)' }}
                    </p>
                    <a href="/contact"
                        class="btn btn-custom btn-custom-outline btn-custom-sm w-100 mb-2 text-center"
                        style="font-size: 0.8rem; border-color: var(--border-color);">
                        <i class="fa-solid fa-paper-plane me-2"></i>Send Message
                    </a>
                </div>
            </div>

            <div class="border-top border-color pt-4 d-flex flex-column flex-md-row align-items-center justify-content-between">
                <p class="mb-0 font-mono text-secondary" style="font-size: 0.8rem;">
                    &copy; {{ new Date().getFullYear() }} {{ settings.owner_name || 'Mahfoozur Rahman' }} (Tusher). All rights reserved.
                </p>
                <div class="mt-3 mt-md-0">
                    <a :href="settings.github_url || 'https://github.com/mahfoozur-rahman'" target="_blank" 
                        class="text-secondary mx-2 fs-5 hover-accent" aria-label="GitHub">
                        <i class="fa-brands fa-github"></i>
                    </a>
                    <a :href="settings.linkedin_url || 'https://linkedin.com/in/mahfoozur-rahman'" target="_blank" 
                        class="text-secondary mx-2 fs-5 hover-accent" aria-label="LinkedIn">
                        <i class="fa-brands fa-linkedin"></i>
                    </a>
                    <a :href="'mailto:' + (settings.email || 'mahfoozur.rahman.bd@gmail.com')" 
                        class="text-secondary mx-2 fs-5 hover-accent" aria-label="Email">
                        <i class="fa-solid fa-envelope"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</template>

<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const settings = computed(() => page.props.settings || {});

const truncateText = (text, maxLength) => {
    if (!text) return '';
    if (text.length <= maxLength) return text;
    return text.substring(0, maxLength) + '...';
};
</script>

<style scoped>
.hover-accent:hover {
    color: var(--accent-primary) !important;
}
</style>
