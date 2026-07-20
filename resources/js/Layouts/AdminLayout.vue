<template>
    <div class="d-flex min-vh-100 bg-primary text-primary-theme font-sans">
        <!-- Sidebar Navigation -->
        <aside class="admin-sidebar d-flex flex-column border-end border-color" :class="{ 'mobile-open': isMobileOpen }">
            <!-- Sidebar Header -->
            <div class="sidebar-header p-4 border-bottom border-color d-flex justify-content-between align-items-center">
                <a href="/admin/dashboard" class="navbar-brand text-gradient font-mono fw-bold fs-5">
                    <i class="fa-solid fa-screwdriver-wrench text-accent me-2"></i>Admin Panel
                </a>
                <button @click="toggleMobileSidebar" class="btn btn-link text-secondary d-lg-none p-0" aria-label="Close Sidebar">
                    <i class="fa-solid fa-xmark fs-5"></i>
                </button>
            </div>

            <!-- Profile Summary -->
            <div class="p-3 border-bottom border-color bg-secondary d-flex align-items-center gap-3">
                <div class="chat-header-avatar" style="width: 40px; height: 40px;">
                    <i class="fa-solid fa-user-tie"></i>
                </div>
                <div>
                    <h5 class="text-primary-theme text-xs font-mono mb-0">Craftsman</h5>
                    <span class="text-secondary-theme" style="font-size: 0.7rem;">Administrator</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-grow-1 p-3">
                <ul class="nav flex-column gap-2">
                    <li class="nav-item">
                        <a href="/admin/dashboard" class="nav-link" :class="{ 'active': url === '/admin/dashboard' }">
                            <i class="fa-solid fa-chart-line me-2"></i>Overview
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/settings" class="nav-link" :class="{ 'active': url === '/admin/settings' }">
                            <i class="fa-solid fa-sliders me-2"></i>Site Settings
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/projects" class="nav-link" :class="{ 'active': url.startsWith('/admin/projects') }">
                            <i class="fa-solid fa-briefcase me-2"></i>Projects Registry
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/experiences" class="nav-link" :class="{ 'active': url.startsWith('/admin/experiences') }">
                            <i class="fa-solid fa-timeline me-2"></i>Experience timeline
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/messages" class="nav-link" :class="{ 'active': url.startsWith('/admin/messages') }">
                            <i class="fa-solid fa-envelope me-2 flex-shrink-0"></i>
                            <span>Inbox Messages</span>
                        </a>
                    </li>
                </ul>

                <hr class="border-color my-4">

                <!-- Client Side & Logout Links -->
                <ul class="nav flex-column gap-2">
                    <li class="nav-item">
                        <a href="/" class="nav-link text-accent">
                            <i class="fa-solid fa-arrow-up-right-from-square me-2"></i>Back to Portfolio
                        </a>
                    </li>
                    <li class="nav-item">
                        <button @click="logout" class="nav-link text-danger w-100 text-start bg-transparent border-0 cursor-pointer">
                            <i class="fa-solid fa-right-from-bracket me-2"></i>Logout Session
                        </button>
                    </li>
                </ul>
            </nav>

            <!-- Sidebar Footer -->
            <div class="p-3 border-top border-color text-center bg-secondary">
                <span class="font-mono text-secondary text-xxs">Crafted with Laravel & Vue</span>
            </div>
        </aside>

        <!-- Overlay backdrop for mobile -->
        <div v-if="isMobileOpen" @click="toggleMobileSidebar" class="sidebar-backdrop d-lg-none"></div>

        <!-- Main Panel Content area -->
        <div class="flex-grow-1 d-flex flex-column overflow-hidden" style="height: 100vh;">
            <!-- Top Dashboard Header -->
            <header class="navbar-custom py-3 border-bottom border-color px-4 d-flex justify-content-between align-items-center">
                <button @click="toggleMobileSidebar" class="btn btn-link text-secondary d-lg-none p-0 me-3" aria-label="Toggle Sidebar">
                    <i class="fa-solid fa-bars fs-4"></i>
                </button>
                <div class="d-flex align-items-center gap-3">
                    <h2 class="h5 font-mono text-primary-theme mb-0 text-capitalize">{{ currentSectionTitle }}</h2>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <!-- Current Date -->
                    <span class="font-mono text-secondary text-xs d-none d-md-inline-block">
                        <i class="fa-regular fa-clock text-accent me-2"></i>{{ currentDate }}
                    </span>
                    <!-- Theme static indicator -->
                    <button @click="toggleTheme" class="theme-toggle-btn d-flex align-items-center justify-content-center cursor-pointer" style="width: 32px; height: 32px; font-size: 0.85rem; border: 1px solid var(--border-color); border-radius: 50%; background: transparent; color: var(--text-primary);">
                        <i :class="theme === 'dark' ? 'fa-solid fa-moon' : 'fa-solid fa-sun text-warning'"></i>
                    </button>
                </div>
            </header>

            <!-- Main Scrollable Workarea -->
            <main class="flex-grow-1 p-4 overflow-y-auto" style="background-color: var(--bg-primary);">
                <!-- Animated Success Toast alert bar -->
                <div v-if="flash.success" class="alert alert-success d-flex align-items-center gap-3 mb-4 font-sans border-0 shadow-sm" role="alert" style="background: rgba(16, 185, 129, 0.1); border-left: 4px solid var(--accent-color) !important; color: #10b981;">
                    <i class="fa-solid fa-circle-check fs-5"></i>
                    <div>
                        {{ flash.success }}
                    </div>
                </div>

                <!-- Animated Alert Notice bar -->
                <div v-if="flash.error" class="alert alert-danger d-flex align-items-center gap-3 mb-4 font-sans border-0 shadow-sm" role="alert" style="background: rgba(239, 68, 68, 0.1); border-left: 4px solid #ef4444 !important; color: #ef4444;">
                    <i class="fa-solid fa-circle-exclamation fs-5"></i>
                    <div>
                        {{ flash.error }}
                    </div>
                </div>

                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

const page = usePage();
const url = computed(() => page.url);
const flash = computed(() => page.props.flash || {});

watch(() => page.props.flash, (newFlash) => {
    if (newFlash && newFlash.success) {
        Swal.fire({
            title: 'Action Complete',
            text: newFlash.success,
            icon: 'success',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: 'var(--bg-secondary)',
            color: 'var(--text-primary)',
            iconColor: 'var(--accent-primary)',
        });
    }
    if (newFlash && newFlash.error) {
        Swal.fire({
            title: 'Notice',
            text: newFlash.error,
            icon: 'error',
            confirmButtonColor: '#ef4444',
            background: 'var(--bg-secondary)',
            color: 'var(--text-primary)',
        });
    }
}, { deep: true });

const isMobileOpen = ref(false);
const theme = ref(localStorage.getItem('theme') || 'dark');

const toggleMobileSidebar = () => {
    isMobileOpen.value = !isMobileOpen.value;
};

const logout = () => {
    if (confirm('Are you absolutely sure you want to terminate your session?')) {
        router.post('/admin/logout');
    }
};

const toggleTheme = () => {
    if (theme.value === 'dark') {
        theme.value = 'light';
        document.body.classList.add('light-mode');
    } else {
        theme.value = 'dark';
        document.body.classList.remove('light-mode');
    }
    localStorage.setItem('theme', theme.value);
};

const currentSectionTitle = computed(() => {
    if (url.value === '/admin/dashboard') return 'Dashboard Overview';
    if (url.value === '/admin/settings') return 'Site Settings';
    if (url.value.startsWith('/admin/projects')) return 'Projects Registry';
    if (url.value.startsWith('/admin/experiences')) return 'Work History Timeline';
    if (url.value.startsWith('/admin/messages')) return 'Connect Messages';
    return 'Admin Workspace';
});

const currentDate = ref('');

onMounted(() => {
    const options = { weekday: 'short', year: 'numeric', month: 'short', day: 'numeric' };
    currentDate.value = new Date().toLocaleDateString('en-US', options);
    
    // Sync theme on mount
    if (theme.value === 'light') {
        document.body.classList.add('light-mode');
    } else {
        document.body.classList.remove('light-mode');
    }
});
</script>

<style scoped>
.admin-sidebar {
    width: 260px;
    flex-shrink: 0;
    background-color: var(--bg-secondary);
    min-height: 100vh;
    transition: transform 0.3s ease;
    z-index: 1035;
}

@media (max-width: 991.98px) {
    .admin-sidebar {
        position: fixed;
        top: 0;
        left: 0;
        transform: translateX(-100%);
    }
    .admin-sidebar.mobile-open {
        transform: translateX(0);
    }
}

.sidebar-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    z-index: 1030;
}

.nav-link {
    font-family: 'Space Grotesk', sans-serif;
    color: var(--text-secondary);
    border-radius: 6px;
    padding: 0.65rem 1rem !important;
    display: flex;
    align-items: center;
    transition: all 0.3s ease;
    border: 1px solid transparent;
}

.nav-link:hover,
.nav-link.active {
    color: var(--text-primary);
    background-color: var(--bg-tertiary);
    border-color: var(--border-color);
}

.nav-link.active i {
    color: var(--accent-primary);
}

.text-xxs {
    font-size: 0.65rem;
}
</style>
