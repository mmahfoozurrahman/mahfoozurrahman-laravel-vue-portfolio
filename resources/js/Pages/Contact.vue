<template>
    <Head title="Contact Me">
        <meta name="description" content="Get in touch with Mahfoozur Rahman. Open to remote full-stack roles and relocation to Japan (Engineer Visa). Drop a message or chat with the AI assistant." />
    </Head>
    <AppLayout>
        <!-- Page Header -->
        <header class="page-header text-center">
            <div class="container" data-aos="fade-down">
                <span class="font-mono text-accent fs-6">GET IN TOUCH</span>
                <h1 class="display-4 mt-2 mb-3">Contact Me</h1>
                <p class="text-secondary mx-auto" style="max-width: 600px;">
                    Have a proposal, an open role, or a technical project you want to discuss? Fill out the form or trigger my AI Assistant for instant inquiries.
                </p>
            </div>
        </header>

        <!-- Contact Content Grid -->
        <section class="py-5">
            <div class="container py-3">
                <div class="row g-5">
                    <!-- Left Column: Form & Placement Alert -->
                    <div class="col-lg-7" data-aos="fade-right">
                        
                        <!-- Dynamic Relocation Alert notice -->
                        <div v-if="settings.relocation_notice" class="alert-custom mb-4" style="background-color: rgba(0, 191, 166, 0.02); border-style: solid;">
                            <div class="alert-custom-icon">
                                <i class="fa-solid fa-plane-departure text-accent"></i>
                            </div>
                            <div>
                                <strong class="text-gradient">Employment Notice:</strong>
                                <p class="mb-0 text-secondary mt-1" style="font-size: 0.85rem;">
                                    {{ settings.relocation_notice }}
                                </p>
                            </div>
                        </div>

                        <!-- Success Alert Box -->
                        <div v-if="flash.success" class="alert alert-success d-flex align-items-center gap-3 mb-4 font-sans border-0 shadow-sm" role="alert" style="background: rgba(16, 185, 129, 0.1); border-left: 4px solid var(--accent-color) !important; color: #10b981;">
                            <i class="fa-solid fa-circle-check fs-5"></i>
                            <div>
                                {{ flash.success }}
                            </div>
                        </div>

                        <!-- Contact Form Panel -->
                        <div class="card-custom h-auto">
                            <h3 class="h4 mb-4 font-mono">
                                <i class="fa-solid fa-square-envelope text-accent me-2"></i>Send Message
                            </h3>
                            
                            <form @submit.prevent="submitForm">
                                <div class="row g-3">
                                    <!-- Name Field -->
                                    <div class="col-md-6">
                                        <label for="name" class="form-label font-mono text-secondary small">Name</label>
                                        <input v-model="form.name" type="text" class="form-control contact-input" id="name" required placeholder="John Doe" :disabled="form.processing">
                                        <div v-if="form.errors.name" class="text-danger text-xxs font-mono mt-1">{{ form.errors.name }}</div>
                                    </div>

                                    <!-- Email Field -->
                                    <div class="col-md-6">
                                        <label for="email" class="form-label font-mono text-secondary small">Email</label>
                                        <input v-model="form.email" type="email" class="form-control contact-input" id="email" required placeholder="john@example.com" :disabled="form.processing">
                                        <div v-if="form.errors.email" class="text-danger text-xxs font-mono mt-1">{{ form.errors.email }}</div>
                                    </div>

                                    <!-- Subject Field -->
                                    <div class="col-12">
                                        <label for="subject" class="form-label font-mono text-secondary small">Subject</label>
                                        <input v-model="form.subject" type="text" class="form-control contact-input" id="subject" required placeholder="Project Inquiry / Job Opening" :disabled="form.processing">
                                        <div v-if="form.errors.subject" class="text-danger text-xxs font-mono mt-1">{{ form.errors.subject }}</div>
                                    </div>

                                    <!-- Message Field -->
                                    <div class="col-12">
                                        <label for="message" class="form-label font-mono text-secondary small">Message</label>
                                        <textarea v-model="form.message" class="form-control contact-input" id="message" rows="5" required placeholder="Hi Mahfoozur, I'd like to discuss..." :disabled="form.processing"></textarea>
                                        <div v-if="form.errors.message" class="text-danger text-xxs font-mono mt-1">{{ form.errors.message }}</div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-custom btn-custom-primary w-100" :disabled="form.processing">
                                            <span v-if="form.processing" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                                            <i v-else class="fa-solid fa-paper-plane me-2"></i>Send Message
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Right Column: Direct Info & AI Prompting Widget -->
                    <div class="col-lg-5" data-aos="fade-left">
                        <!-- Direct Info Block -->
                        <div class="card-custom mb-4 h-auto">
                            <h3 class="h4 mb-4 font-mono"><i class="fa-solid fa-address-card text-accent me-2"></i>Inquiries</h3>
                            
                            <!-- Email -->
                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <i class="fa-solid fa-envelope"></i>
                                </div>
                                <div>
                                    <span class="font-mono text-secondary small d-block">EMAIL ADDRESS</span>
                                    <a :href="'mailto:' + (settings.email || 'mahfoozur.rahman@example.com')" class="text-primary font-mono fw-semibold">
                                        {{ settings.email || 'mahfoozur.rahman@example.com' }}
                                    </a>
                                </div>
                            </div>

                            <!-- LinkedIn -->
                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                </div>
                                <div>
                                    <span class="font-mono text-secondary small d-block">LINKEDIN</span>
                                    <a :href="settings.linkedin_url || 'https://linkedin.com/in/mahfoozur-rahman'" target="_blank" class="text-primary font-mono fw-semibold">
                                        {{ settings.linkedin_url ? settings.linkedin_url.replace('https://', '') : 'linkedin.com/in/mahfoozur-rahman' }}
                                    </a>
                                </div>
                            </div>

                            <!-- GitHub -->
                            <div class="contact-info-item">
                                <div class="contact-info-icon">
                                    <i class="fa-brands fa-github"></i>
                                </div>
                                <div>
                                    <span class="font-mono text-secondary small d-block">GITHUB</span>
                                    <a :href="settings.github_url || 'https://github.com/mmrahman'" target="_blank" class="text-primary font-mono fw-semibold">
                                        {{ settings.github_url ? settings.github_url.replace('https://', '') : 'github.com/mmrahman' }}
                                    </a>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="contact-info-item mb-0">
                                <div class="contact-info-icon">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div>
                                    <span class="font-mono text-secondary small d-block">LOCATION</span>
                                    <span class="text-primary font-mono fw-semibold">
                                        {{ settings.location || 'Dhaka, Bangladesh' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Interactive Bot Widget Promo -->
                        <div class="card-custom h-auto" style="border-color: var(--accent-primary); box-shadow: 0 8px 30px var(--accent-glow);">
                            <h3 class="h4 mb-2 font-mono text-accent"><i class="fa-solid fa-robot me-2"></i>AI Assistant</h3>
                            <p class="text-secondary small mb-4">
                                Don't want to wait for an email? Chat with my interactive digital assistant to get instantaneous, structured answers.
                            </p>
                            
                            <div class="mb-4">
                                <span class="font-mono text-secondary small d-block mb-2">QUICK TOPICS TO ASK:</span>
                                <div class="d-flex flex-column gap-2">
                                    <button @click="triggerAIQuery('Are you ready to relocate to Japan?')" class="btn btn-custom btn-custom-outline btn-custom-sm text-start py-2 font-mono">
                                        <i class="fa-solid fa-location-arrow me-2 text-accent"></i>Are you ready to relocate to Japan?
                                    </button>
                                    <button @click="triggerAIQuery('What is your primary tech stack?')" class="btn btn-custom btn-custom-outline btn-custom-sm text-start py-2 font-mono">
                                        <i class="fa-solid fa-location-arrow me-2 text-accent"></i>What is your primary tech stack?
                                    </button>
                                </div>
                            </div>

                            <button @click="openChatTrigger" class="btn btn-custom btn-custom-primary w-100 py-2">
                                <i class="fa-solid fa-comments me-2"></i>Open Chat Widget
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </AppLayout>
</template>

<script setup>
import { computed } from 'vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import AppLayout from '../Layouts/AppLayout.vue';

defineProps({
    settings: Object,
});

const page = usePage();
const flash = computed(() => page.props.flash || {});

const form = useForm({
    name: '',
    email: '',
    subject: '',
    message: '',
});

const submitForm = () => {
    form.post('/contact', {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
    });
};

const openChatTrigger = () => {
    const trigger = document.getElementById('chatTrigger');
    if (trigger) trigger.click();
};

const triggerAIQuery = (query) => {
    openChatTrigger();
    // Wait a brief millisecond for DOM transition, then find the chatbot input and dispatch the query
    setTimeout(() => {
        const input = document.querySelector('.chat-input-field');
        if (input) {
            input.value = query;
            const event = new KeyboardEvent('keyup', { key: 'Enter' });
            input.dispatchEvent(event);
            
            // Re-bind reactive state if element has input model binding
            const sendBtn = document.querySelector('.chat-send-btn');
            if (sendBtn) sendBtn.click();
        }
    }, 300);
};
</script>
