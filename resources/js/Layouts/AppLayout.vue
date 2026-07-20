<template>
    <div class="d-flex flex-column min-vh-100">
        <!-- Preloader (Initial Page Load Only) -->
        <div v-if="showPreloader" id="preloader" :class="{ 'fade-out': preloaderFade }">
            <div class="preloader-content">
                <div class="preloader-spinner">
                    <div class="spinner-ring"></div>
                    <div class="spinner-ring-inner"></div>
                    <i class="fa-solid fa-terminal preloader-icon text-accent"></i>
                </div>
                <span class="preloader-text font-mono">Mahfoozur<span>.dev</span></span>
            </div>
        </div>

        <!-- Engaging Page Switching Loader -->
        <div v-if="isNavigating" class="page-switch-overlay">
            <div class="page-switch-spinner">
                <div class="spinner-ring"></div>
                <div class="spinner-ring-inner"></div>
                <i class="fa-solid fa-spinner fa-spin page-switch-icon text-accent"></i>
            </div>
            <span class="page-switch-text font-mono mt-3">Loading Page...</span>
        </div>

        <!-- Navbar Header -->
        <Navbar />

        <!-- Dynamic Main Slot Container -->
        <main class="flex-grow-1">
            <slot />
        </main>

        <!-- Dynamic AI Assistant chatbot widget -->
        <AIChatWidget />

        <!-- Footer -->
        <Footer />
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';
import AOS from 'aos';
import Navbar from '../Components/Navbar.vue';
import Footer from '../Components/Footer.vue';
import AIChatWidget from '../Components/AIChatWidget.vue';

const showPreloader = ref(true);
const preloaderFade = ref(false);
const isNavigating = ref(false);

// Register Inertia Navigation Listeners for engaging switching spinner
router.on('start', () => {
    isNavigating.value = true;
});

router.on('finish', () => {
    isNavigating.value = false;
    // Refresh scroll animations
    setTimeout(() => {
        AOS.refresh();
    }, 100);
});

onMounted(() => {
    // Dismiss preloader
    setTimeout(() => {
        preloaderFade.value = true;
        setTimeout(() => {
            showPreloader.value = false;
            document.body.classList.remove('loading');
        }, 500);
    }, 600);

    // Initialize AOS
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
    });
});
</script>

<style scoped>
/* Page Switch Transition Overlay */
.page-switch-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(10, 16, 26, 0.85);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    z-index: 99999;
    backdrop-filter: blur(10px);
}

body.light-mode .page-switch-overlay {
    background: rgba(244, 246, 249, 0.85);
}

.page-switch-spinner {
    position: relative;
    width: 90px;
    height: 90px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.page-switch-spinner .spinner-ring {
    position: absolute;
    width: 100%;
    height: 100%;
    border: 3px solid transparent;
    border-top-color: var(--accent-color, #10b981);
    border-bottom-color: var(--accent-color, #10b981);
    border-radius: 50%;
    animation: spin 1.5s cubic-bezier(0.5, 0, 0.5, 1) infinite;
}

.page-switch-spinner .spinner-ring-inner {
    position: absolute;
    width: 80%;
    height: 80%;
    border: 3px solid transparent;
    border-left-color: var(--text-muted, #94a3b8);
    border-right-color: var(--text-muted, #94a3b8);
    border-radius: 50%;
    animation: spin-reverse 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
}

.page-switch-icon {
    font-size: 2rem;
    z-index: 10;
}

.page-switch-text {
    font-size: 0.95rem;
    color: var(--text-muted, #94a3b8);
    letter-spacing: 0.1em;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes spin-reverse {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(-360deg); }
}
</style>
