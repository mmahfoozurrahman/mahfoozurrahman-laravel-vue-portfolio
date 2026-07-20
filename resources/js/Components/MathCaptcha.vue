<template>
    <div class="math-captcha-wrapper">
        <label class="form-label font-mono text-secondary small d-block mb-2">
            {{ label }}
            <span class="text-danger ms-1">*</span>
        </label>

        <div class="d-flex align-items-stretch gap-2">
            <!-- Challenge Question Display -->
            <div class="captcha-question-box d-flex align-items-center justify-content-center position-relative" :class="{ 'is-loading': isLoading }">
                <Transition name="captcha-fade" mode="out-in">
                    <span v-if="isLoading" key="loading" class="d-flex align-items-center">
                        <span class="spinner-border spinner-border-sm text-secondary" role="status" aria-hidden="true"></span>
                    </span>
                    <span v-else key="question" class="font-mono captcha-question-text">
                        {{ question }} <span class="text-secondary">=</span> <span class="text-accent">?</span>
                    </span>
                </Transition>

                <button
                    type="button"
                    class="captcha-refresh-btn"
                    @click="fetchChallenge"
                    :disabled="isLoading"
                    tabindex="-1"
                    :title="isLoading ? 'Loading...' : 'Get a new challenge'"
                    :aria-label="isLoading ? 'Loading new challenge' : 'Refresh captcha challenge'"
                >
                    <i class="fa-solid fa-rotate" :class="{ 'fa-spin': isLoading }"></i>
                </button>
            </div>

            <!-- Answer Input -->
            <div class="position-relative flex-grow-1">
                <div class="input-icon-wrapper">
                    <i class="fa-solid fa-shield-halved input-icon"></i>
                    <input
                        :value="modelValue"
                        @input="onInput"
                        @blur="$emit('blur')"
                        type="text"
                        inputmode="numeric"
                        pattern="[0-9-]*"
                        class="form-control contact-input ps-5 captcha-answer-input"
                        :class="{ 'is-invalid': error }"
                        :placeholder="placeholder"
                        :autocomplete="autocomplete"
                        :disabled="isLoading"
                    >
                </div>
            </div>
        </div>

        <!-- Error Message -->
        <Transition name="error-fade">
            <div v-if="error" class="field-error-message">
                <i class="fa-solid fa-circle-exclamation me-1"></i>
                {{ error }}
            </div>
        </Transition>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({
    /** v-model bound value (the user's answer) */
    modelValue: {
        type: [String, Number],
        default: '',
    },
    /** External error message to display (e.g. from server validation) */
    error: {
        type: String,
        default: null,
    },
    /** Endpoint that returns { question: string } */
    endpoint: {
        type: String,
        default: '/captcha/math',
    },
    /** Custom label text */
    label: {
        type: String,
        default: 'Human Verification',
    },
    /** Placeholder for the answer input */
    placeholder: {
        type: String,
        default: 'Your answer',
    },
    /** Autocomplete attribute */
    autocomplete: {
        type: String,
        default: 'off',
    },
});

const emit = defineEmits(['update:modelValue', 'blur', 'refreshed']);

const question = ref('');
const isLoading = ref(false);

/**
 * Fetch a fresh captcha challenge from the server.
 * Exposed via defineExpose so parent components can trigger a refresh
 * (e.g. after a failed form submission).
 */
async function fetchChallenge() {
    isLoading.value = true;
    try {
        const response = await fetch(props.endpoint, {
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
        });

        if (!response.ok) {
            throw new Error(`HTTP ${response.status}`);
        }

        const data = await response.json();
        question.value = data.question;
        emit('refreshed', question.value);
    } catch (e) {
        // Fallback: generate a client-side challenge if the server is unreachable.
        // This keeps the form usable but the server will still validate its own answer.
        const a = Math.floor(Math.random() * 20) + 1;
        const b = Math.floor(Math.random() * 20) + 1;
        const op = Math.random() > 0.5 ? '+' : '-';
        const [x, y] = op === '-' && b > a ? [b, a] : [a, b];
        question.value = `${x} ${op} ${y}`;
        emit('refreshed', question.value);
    } finally {
        isLoading.value = false;
    }
}

/** Handle input — emit value and clear nothing (parent manages errors) */
function onInput(event) {
    emit('update:modelValue', event.target.value);
}

onMounted(() => {
    fetchChallenge();
});

// Expose refresh method for parent components
defineExpose({ refresh: fetchChallenge });
</script>

<style scoped>
.math-captcha-wrapper {
    width: 100%;
}

/* Challenge Question Box */
.captcha-question-box {
    min-width: 130px;
    padding: 0.625rem 2.5rem 0.625rem 1rem;
    background-color: var(--input-bg, #203126);
    border: 1px solid var(--border-color, rgba(242, 161, 27, 0.15));
    border-radius: 6px;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
    user-select: none;
}

.captcha-question-box.is-loading {
    opacity: 0.7;
}

.captcha-question-text {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary, #f5eedc);
    letter-spacing: 0.05em;
    white-space: nowrap;
}

/* Refresh Button */
.captcha-refresh-btn {
    position: absolute;
    right: 6px;
    top: 50%;
    transform: translateY(-50%);
    background: transparent;
    border: none;
    color: var(--text-secondary, #c1ccc3);
    cursor: pointer;
    padding: 4px 6px;
    font-size: 0.75rem;
    z-index: 2;
    transition: color 0.2s ease, transform 0.3s ease;
    border-radius: 4px;
}

.captcha-refresh-btn:hover:not(:disabled) {
    color: var(--accent-primary, #f2a11b);
    transform: translateY(-50%) rotate(180deg);
}

.captcha-refresh-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Answer Input */
.captcha-answer-input {
    text-align: center;
    font-family: 'Space Mono', 'JetBrains Mono', Courier, monospace;
    font-weight: 600;
    letter-spacing: 0.05em;
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

/* Input Icon Wrapper */
.input-icon-wrapper {
    position: relative;
}

.input-icon {
    position: absolute;
    left: 18px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-secondary, #c1ccc3);
    font-size: 0.875rem;
    z-index: 2;
    transition: color 0.2s ease;
}

/* Transitions */
.error-fade-enter-active,
.error-fade-leave-active {
    transition: all 0.3s ease;
}

.error-fade-enter-from,
.error-fade-leave-to {
    opacity: 0;
    transform: translateY(-8px);
}

.captcha-fade-enter-active,
.captcha-fade-leave-active {
    transition: all 0.25s ease;
}

.captcha-fade-enter-from,
.captcha-fade-leave-to {
    opacity: 0;
    transform: scale(0.95);
}

/* Focus state enhancement */
.form-control:focus {
    border-color: var(--accent-primary, #6366f1);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
}

.form-control {
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}
</style>