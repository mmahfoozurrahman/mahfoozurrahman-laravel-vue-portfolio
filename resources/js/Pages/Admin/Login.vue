<template>
    <Head title="Administrative Login - Craftsman Hub" />
    
    <div class="login-wrapper d-flex align-items-center justify-content-center min-vh-100 p-4">
        <!-- Floating Theme switcher at the top right -->
        <button @click="toggleTheme" class="theme-toggle-btn d-flex align-items-center justify-content-center position-absolute" style="top: 24px; right: 24px; width: 40px; height: 40px; border: 1px solid var(--border-color); border-radius: 50%; background: transparent; color: var(--text-primary);">
            <i :class="theme === 'dark' ? 'fa-solid fa-moon' : 'fa-solid fa-sun text-warning'"></i>
        </button>

        <div class="card-custom max-width-sm w-100 p-4 p-md-5 overflow-hidden position-relative" style="background-color: var(--bg-secondary);">
            <!-- Card Brand Header -->
            <div class="text-center mb-4">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-secondary mb-3 border border-color" style="width: 60px; height: 60px;">
                    <i class="fa-solid fa-screwdriver-wrench text-accent fs-3"></i>
                </div>
                <h3 class="h4 font-mono text-white mb-1">Craftsman Hub</h3>
                <p class="text-secondary small font-sans mb-0">Administrative Access Authentication Panel</p>
            </div>

            <!-- Error Banner -->
            <div v-if="form.errors.email" class="alert alert-danger d-flex align-items-center gap-2 mb-4 font-mono text-xxs border-0" role="alert" style="background: rgba(239, 68, 68, 0.1); border-left: 3px solid #ef4444 !important; color: #ef4444; padding: 0.75rem 1rem;">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <div>{{ form.errors.email }}</div>
            </div>

            <form @submit.prevent="submitLogin">
                <div class="mb-3">
                    <label for="email" class="form-label font-mono text-secondary small">Email Address</label>
                    <div class="position-relative">
                        <input v-model="form.email" type="email" class="form-control contact-input ps-4" id="email" placeholder="admin@example.com" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label font-mono text-secondary small">Credentials Token (Password)</label>
                    <div class="position-relative">
                        <input v-model="form.password" type="password" class="form-control contact-input ps-4" id="password" placeholder="••••••••••••" required>
                    </div>
                </div>

                <div class="mb-4 d-flex align-items-center justify-content-between">
                    <div class="form-check form-switch">
                        <input v-model="form.remember" class="form-check-input" type="checkbox" id="remember">
                        <label class="form-check-label font-mono text-secondary small ms-2" for="remember">Keep Signed In</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-custom btn-custom-primary w-100 py-3 font-sans d-flex align-items-center justify-content-center" :disabled="form.processing">
                    <span v-if="form.processing" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                    <i v-else class="fa-solid fa-lock-open me-2"></i>Authenticate Session
                </button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';

const theme = ref(localStorage.getItem('theme') || 'dark');

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

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

const submitLogin = () => {
    form.post('/admin/login', {
        onFinish: () => form.reset('password'),
    });
};

onMounted(() => {
    // Sync theme on mount
    if (theme.value === 'light') {
        document.body.classList.add('light-mode');
    } else {
        document.body.classList.remove('light-mode');
    }
});
</script>

<style scoped>
.login-wrapper {
    background-color: var(--bg-primary);
    position: relative;
}

.max-width-sm {
    max-width: 440px;
}
</style>
