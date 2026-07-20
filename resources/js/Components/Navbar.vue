<template>
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top">
        <div class="container">
            <!-- Brand Logo -->
            <a href="/" class="navbar-brand">
                <i class="fa-solid fa-terminal text-accent me-2"></i>Mahfoozur<span>Rahman</span>
            </a>

            <!-- Mobile Toggle Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a href="/" class="nav-link" :class="{ 'active': url === '/' }">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="/experience" class="nav-link" :class="{ 'active': url === '/experience' }">Experience</a>
                    </li>
                    <li class="nav-item">
                        <a href="/portfolio" class="nav-link" :class="{ 'active': url === '/portfolio' }">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a href="/github" class="nav-link" :class="{ 'active': url === '/github' }">GitHub</a>
                    </li>
                    <li class="nav-item">
                        <a href="/contact" class="nav-link" :class="{ 'active': url === '/contact' }">Contact</a>
                    </li>

                    <!-- Premium Theme Toggler Button -->
                    <li class="nav-item ms-lg-3 mt-3 mt-lg-0">
                        <button @click="toggleTheme" class="theme-toggle-btn" id="theme-toggle"
                            :title="theme === 'dark' ? 'Switch to Light Mode' : 'Switch to Dark Mode'"
                            :aria-label="theme === 'dark' ? 'Switch to Light Mode' : 'Switch to Dark Mode'">
                            <i :class="theme === 'dark' ? 'fa-solid fa-moon' : 'fa-solid fa-sun'"></i>
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const url = computed(() => page.url);

const theme = ref('dark');

const toggleTheme = () => {
    theme.value = theme.value === 'dark' ? 'light' : 'dark';
    localStorage.setItem('theme', theme.value);
    applyTheme();
};

const applyTheme = () => {
    if (theme.value === 'light') {
        document.body.classList.add('light-mode');
    } else {
        document.body.classList.remove('light-mode');
    }
};

onMounted(() => {
    theme.value = localStorage.getItem('theme') || 'dark';
    applyTheme();
});
</script>
