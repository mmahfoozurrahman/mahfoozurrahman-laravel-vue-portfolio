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

            <!-- General Error Banner -->
            <Transition name="slide-fade">
                <div v-if="generalError" class="alert alert-danger d-flex align-items-center gap-2 mb-4 font-mono text-xxs border-0" role="alert" style="background: rgba(239, 68, 68, 0.1); border-left: 3px solid #ef4444 !important; color: #ef4444; padding: 0.75rem 1rem;">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <div>{{ generalError }}</div>
                </div>
            </Transition>

            <form @submit.prevent="submitLogin" novalidate>
                <!-- Email Field -->
                <div class="mb-3">
                    <label for="email" class="form-label font-mono text-secondary small">
                        Email Address
                        <span class="text-danger ms-1">*</span>
                    </label>
                    <div class="position-relative">
                        <div class="input-icon-wrapper">
                            <i class="fa-solid fa-envelope input-icon"></i>
                            <input 
                                v-model="form.email" 
                                @input="clearError('email')"
                                @blur="validateField('email')"
                                type="email" 
                                class="form-control contact-input ps-5" 
                                :class="{ 'is-invalid': hasError('email') }"
                                id="email" 
                                placeholder="admin@example.com"
                                autocomplete="email"
                            >
                        </div>
                        <!-- Validation Error Message -->
                        <Transition name="error-fade">
                            <div v-if="hasError('email')" class="field-error-message">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>
                                {{ getError('email') }}
                            </div>
                        </Transition>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="mb-4">
                    <label for="password" class="form-label font-mono text-secondary small">
                        Credentials Token (Password)
                        <span class="text-danger ms-1">*</span>
                    </label>
                    <div class="position-relative">
                        <div class="input-icon-wrapper">
                            <i class="fa-solid fa-key input-icon"></i>
                            <input 
                                v-model="form.password" 
                                @input="clearError('password')"
                                @blur="validateField('password')"
                                :type="showPassword ? 'text' : 'password'" 
                                class="form-control contact-input ps-5 pe-5" 
                                :class="{ 'is-invalid': hasError('password') }"
                                id="password" 
                                placeholder="••••••••••••"
                                autocomplete="current-password"
                            >
                            <button 
                                type="button" 
                                class="password-toggle-btn" 
                                @click="showPassword = !showPassword"
                                tabindex="-1"
                            >
                                <i :class="showPassword ? 'fa-solid fa-eye-slash' : 'fa-solid fa-eye'"></i>
                            </button>
                        </div>
                        <!-- Validation Error Message -->
                        <Transition name="error-fade">
                            <div v-if="hasError('password')" class="field-error-message">
                                <i class="fa-solid fa-circle-exclamation me-1"></i>
                                {{ getError('password') }}
                            </div>
                        </Transition>
                    </div>
                </div>

                <div class="mb-4 d-flex align-items-center justify-content-between">
                    <div class="form-check form-switch">
                        <input v-model="form.remember" class="form-check-input" type="checkbox" id="remember">
                        <label class="form-check-label font-mono text-secondary small ms-2" for="remember">Keep Signed In</label>
                    </div>
                </div>

                <!-- Math Captcha Verification -->
                <div class="mb-4">
                    <MathCaptcha
                        ref="captchaRef"
                        v-model="form.captcha"
                        :error="getError('captcha')"
                        @input="clearError('captcha')"
                        @blur="validateField('captcha')"
                        label="Security Check"
                        placeholder="Answer"
                    />
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
import { ref, computed, onMounted, watch } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import MathCaptcha from '../../Components/MathCaptcha.vue';

const theme = ref(localStorage.getItem('theme') || 'dark');
const showPassword = ref(false);

// Reference to the MathCaptcha component (used to refresh challenge after failures)
const captchaRef = ref(null);

// Local validation errors (client-side)
const localErrors = ref({
    email: null,
    password: null,
    captcha: null,
});

// Track which fields have been touched (blurred at least once)
const touched = ref({
    email: false,
    password: false,
    captcha: false,
});

const form = useForm({
    email: '',
    password: '',
    captcha: '',
    remember: false,
});

// Computed: General error (non-field-specific errors from server)
const generalError = computed(() => {
    // If there's a server error that's not field-specific, show it in banner
    if (form.errors.email && !touched.value.email) {
        return form.errors.email;
    }
    return null;
});

// Check if a field has an error (local or server)
const hasError = (field) => {
    return localErrors.value[field] || form.errors[field];
};

// Get the error message for a field
const getError = (field) => {
    return localErrors.value[field] || form.errors[field];
};

// Clear error when user starts typing
const clearError = (field) => {
    if (localErrors.value[field]) {
        localErrors.value[field] = null;
    }
    // Also clear server error for this field
    if (form.errors[field]) {
        form.clearErrors(field);
    }
};

// Validate a single field
const validateField = (field) => {
    touched.value[field] = true;
    
    switch (field) {
        case 'email':
            if (!form.email || form.email.trim() === '') {
                localErrors.value.email = 'Email address is required';
            } else if (!isValidEmail(form.email)) {
                localErrors.value.email = 'Please enter a valid email address';
            } else {
                localErrors.value.email = null;
            }
            break;
            
        case 'password':
            if (!form.password || form.password.trim() === '') {
                localErrors.value.password = 'Password is required';
            } else if (form.password.length < 6) {
                localErrors.value.password = 'Password must be at least 6 characters';
            } else {
                localErrors.value.password = null;
            }
            break;

        case 'captcha':
            if (!form.captcha || form.captcha.trim() === '') {
                localErrors.value.captcha = 'Please solve the security check';
            } else {
                localErrors.value.captcha = null;
            }
            break;
    }
};

// Email validation regex
const isValidEmail = (email) => {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
};

// Validate all fields before submission
const validateAll = () => {
    let isValid = true;
    
    // Mark all fields as touched
    touched.value.email = true;
    touched.value.password = true;
    touched.value.captcha = true;
    
    // Validate email
    if (!form.email || form.email.trim() === '') {
        localErrors.value.email = 'Email address is required';
        isValid = false;
    } else if (!isValidEmail(form.email)) {
        localErrors.value.email = 'Please enter a valid email address';
        isValid = false;
    } else {
        localErrors.value.email = null;
    }
    
    // Validate password
    if (!form.password || form.password.trim() === '') {
        localErrors.value.password = 'Password is required';
        isValid = false;
    } else if (form.password.length < 6) {
        localErrors.value.password = 'Password must be at least 6 characters';
        isValid = false;
    } else {
        localErrors.value.password = null;
    }

    // Validate captcha
    if (!form.captcha || form.captcha.trim() === '') {
        localErrors.value.captcha = 'Please solve the security check';
        isValid = false;
    } else {
        localErrors.value.captcha = null;
    }
    
    return isValid;
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

const submitLogin = () => {
    // Run client-side validation first
    if (!validateAll()) {
        return;
    }
    
    form.post('/admin/login', {
        onError: (errors) => {
            // Mark fields as touched to show server errors inline
            touched.value.email = true;
            touched.value.password = true;
            touched.value.captcha = true;

            // If the server rejected the captcha, fetch a fresh challenge
            // (the backend regenerates the session answer on failure)
            if (errors.captcha && captchaRef.value) {
                captchaRef.value.refresh();
                form.captcha = '';
            }
        },
        onFinish: () => {
            form.reset('password');
            // Always clear the captcha answer after an attempt (success or failure)
            form.captcha = '';
        },
    });
};

// Watch for server errors and mark fields as touched
watch(() => form.errors, (newErrors) => {
    if (newErrors.email) touched.value.email = true;
    if (newErrors.password) touched.value.password = true;
    if (newErrors.captcha) touched.value.captcha = true;
}, { deep: true });

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

/* Input Icon Wrapper */
.input-icon-wrapper {
    position: relative;
}

.input-icon {
    position: absolute;
    left: 18px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-secondary);
    font-size: 0.875rem;
    z-index: 2;
    transition: color 0.2s ease;
}

/* Invalid Input Styling */
.form-control.is-invalid {
    border-color: #ef4444 !important;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
    background-image: none;
}

.form-control.is-invalid:focus {
    border-color: #ef4444 !important;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2) !important;
}

/* When input is invalid, make the icon red too */
.input-icon-wrapper .form-control.is-invalid ~ .input-icon,
.input-icon-wrapper:has(.is-invalid) .input-icon {
    color: #ef4444;
}

/* Field Error Message */
.field-error-message {
    display: flex;
    align-items: center;
    margin-top: 8px;
    padding: 6px 12px;
    font-size: 0.75rem;
    font-family: 'JetBrains Mono', monospace;
    color: #ef4444;
    background: rgba(239, 68, 68, 0.08);
    border-radius: 6px;
    border-left: 3px solid #ef4444;
}

.field-error-message i {
    font-size: 0.7rem;
}

/* Password Toggle Button */
.password-toggle-btn {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    background: transparent;
    border: none;
    color: var(--text-secondary);
    cursor: pointer;
    padding: 4px 8px;
    z-index: 2;
    transition: color 0.2s ease;
}

.password-toggle-btn:hover {
    color: var(--text-primary);
}

/* Error Message Transition */
.error-fade-enter-active,
.error-fade-leave-active {
    transition: all 0.3s ease;
}

.error-fade-enter-from,
.error-fade-leave-to {
    opacity: 0;
    transform: translateY(-8px);
}

/* Slide Fade Transition for Banner */
.slide-fade-enter-active,
.slide-fade-leave-active {
    transition: all 0.3s ease;
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}

/* Focus state enhancement */
.form-control:focus {
    border-color: var(--accent-color, #6366f1);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
}

/* Smooth transition for input borders */
.form-control {
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}
</style>
