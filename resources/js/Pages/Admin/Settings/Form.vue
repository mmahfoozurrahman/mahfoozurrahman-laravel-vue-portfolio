<template>
    <Head title="Site Settings - Administrative Hub" />
    <AdminLayout>
        <!-- Back Navigation row -->
        <div class="mb-4">
            <a href="/admin/dashboard" class="btn btn-custom btn-custom-outline btn-custom-sm font-mono">
                <i class="fa-solid fa-arrow-left me-2"></i>Back to Overview
            </a>
        </div>

        <div class="card-custom h-auto max-width-lg mx-auto">
            <div class="border-bottom border-color pb-3 mb-4">
                <h3 class="h4 font-mono text-primary-theme mb-1"><i class="fa-solid fa-sliders text-accent me-2"></i>Global Site Settings</h3>
                <p class="text-secondary-theme small font-sans mb-0">Update owner metrics, contact endpoints, relocation highlights, and SEO parameters.</p>
            </div>

            <!-- Form Wrapper -->
            <form @submit.prevent="saveSettings">
                <div class="row g-4">
                    <!-- Owner Name & Role -->
                    <div class="col-md-6">
                        <label for="owner_name" class="form-label font-mono text-secondary-theme small">Owner Full Name</label>
                        <input v-model="form.owner_name" type="text" class="form-control contact-input" id="owner_name" placeholder="John Doe">
                        <div v-if="form.errors.owner_name" class="text-danger text-xxs font-mono mt-1">{{ form.errors.owner_name }}</div>
                    </div>
                    <div class="col-md-6">
                        <label for="owner_role" class="form-label font-mono text-secondary-theme small">Owner Role/Title</label>
                        <input v-model="form.owner_role" type="text" class="form-control contact-input" id="owner_role" placeholder="Full-Stack Developer">
                        <div v-if="form.errors.owner_role" class="text-danger text-xxs font-mono mt-1">{{ form.errors.owner_role }}</div>
                    </div>

                    <!-- Owner Bio -->
                    <div class="col-12">
                        <label for="owner_bio" class="form-label font-mono text-secondary-theme small">About Me Bio</label>
                        <textarea v-model="form.owner_bio" class="form-control contact-input" id="owner_bio" rows="4" placeholder="A brief narrative about your technical expertise..."></textarea>
                        <div v-if="form.errors.owner_bio" class="text-danger text-xxs font-mono mt-1">{{ form.errors.owner_bio }}</div>
                    </div>

                    <!-- Location & Email -->
                    <div class="col-md-6">
                        <label for="location" class="form-label font-mono text-secondary-theme small">Physical Location</label>
                        <input v-model="form.location" type="text" class="form-control contact-input" id="location" placeholder="Dhaka, Bangladesh">
                        <div v-if="form.errors.location" class="text-danger text-xxs font-mono mt-1">{{ form.errors.location }}</div>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label font-mono text-secondary-theme small">Contact Email Address</label>
                        <input v-model="form.email" type="email" class="form-control contact-input" id="email" placeholder="john@example.com">
                        <div v-if="form.errors.email" class="text-danger text-xxs font-mono mt-1">{{ form.errors.email }}</div>
                    </div>

                    <!-- Relocation notice description -->
                    <div class="col-12">
                        <label for="relocation_notice" class="form-label font-mono text-secondary-theme small">Relocation & Visa Announcement</label>
                        <textarea v-model="form.relocation_notice" class="form-control contact-input" id="relocation_notice" rows="2" placeholder="Announcements regarding Japan relocation eligibility..."></textarea>
                        <div v-if="form.errors.relocation_notice" class="text-danger text-xxs font-mono mt-1">{{ form.errors.relocation_notice }}</div>
                    </div>

                    <!-- LinkedIn & GitHub URLs -->
                    <div class="col-md-6">
                        <label for="linkedin_url" class="form-label font-mono text-secondary-theme small">LinkedIn URL</label>
                        <input v-model="form.linkedin_url" type="url" class="form-control contact-input" id="linkedin_url" placeholder="https://linkedin.com/in/username">
                        <div v-if="form.errors.linkedin_url" class="text-danger text-xxs font-mono mt-1">{{ form.errors.linkedin_url }}</div>
                    </div>
                    <div class="col-md-6">
                        <label for="github_url" class="form-label font-mono text-secondary-theme small">GitHub Workspace URL</label>
                        <input v-model="form.github_url" type="url" class="form-control contact-input" id="github_url" placeholder="https://github.com/username">
                        <div v-if="form.errors.github_url" class="text-danger text-xxs font-mono mt-1">{{ form.errors.github_url }}</div>
                    </div>

                    <!-- AI Twin Greeting prompt -->
                    <div class="col-12 border-top border-color pt-3 mt-4">
                        <h4 class="text-primary-theme text-xs font-mono mb-2"><i class="fa-solid fa-robot text-accent me-2"></i>AI Twin Conversation Parameters</h4>
                    </div>
                    <div class="col-12">
                        <label for="ai_assistant_welcome" class="form-label font-mono text-secondary-theme small">AI Assistant Welcome Greeting</label>
                        <textarea v-model="form.ai_assistant_welcome" class="form-control contact-input" id="ai_assistant_welcome" rows="2" placeholder="Default welcome message displayed in floating chat widget..."></textarea>
                        <div v-if="form.errors.ai_assistant_welcome" class="text-danger text-xxs font-mono mt-1">{{ form.errors.ai_assistant_welcome }}</div>
                    </div>

                    <!-- Meta SEO Information -->
                    <div class="col-12 border-top border-color pt-3 mt-4">
                        <h4 class="text-primary-theme text-xs font-mono mb-2"><i class="fa-solid fa-earth-americas text-accent me-2"></i>Search Engine Optimization (SEO)</h4>
                    </div>
                    <div class="col-12">
                        <label for="meta_description" class="form-label font-mono text-secondary-theme small">Meta Description Tag</label>
                        <textarea v-model="form.meta_description" class="form-control contact-input" id="meta_description" rows="2" placeholder="Summary snippet parsed by search engines..."></textarea>
                        <div v-if="form.errors.meta_description" class="text-danger text-xxs font-mono mt-1">{{ form.errors.meta_description }}</div>
                    </div>

                    <!-- File Attachments: Profile Avatar & Resume PDF -->
                    <div class="col-12 border-top border-color pt-3 mt-4">
                        <h4 class="text-primary-theme text-xs font-mono mb-2"><i class="fa-solid fa-paperclip text-accent me-2"></i>Attachments & Media</h4>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="avatar" class="form-label font-mono text-secondary-theme small">Upload Profile Avatar (Max 2MB)</label>
                        <input @change="onAvatarChange" type="file" class="form-control contact-input" id="avatar" accept="image/*">
                        <div v-if="form.errors.avatar" class="text-danger text-xxs font-mono mt-1">{{ form.errors.avatar }}</div>
                        <div v-if="settings.owner_avatar" class="text-secondary-theme text-xxs font-mono mt-1">Current file: {{ settings.owner_avatar }}</div>
                    </div>
                    <div class="col-md-6">
                        <label for="resume" class="form-label font-mono text-secondary-theme small">Upload Resume PDF (Max 5MB)</label>
                        <input @change="onResumeChange" type="file" class="form-control contact-input" id="resume" accept="application/pdf">
                        <div v-if="form.errors.resume" class="text-danger text-xxs font-mono mt-1">{{ form.errors.resume }}</div>
                        <div v-if="settings.resume_url" class="text-secondary-theme text-xxs font-mono mt-1">Current file: {{ settings.resume_url }}</div>
                    </div>

                    <!-- Form Submissions Action Footer -->
                    <div class="col-12 border-top border-color mt-4 pt-3 d-flex justify-content-end">
                        <button type="submit" class="btn btn-custom btn-custom-primary px-5 py-3" :disabled="form.processing">
                            <span v-if="form.processing" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                            <i v-else class="fa-solid fa-circle-check me-2"></i>Save Site Settings
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

const props = defineProps({
    settings: Object,
});

const form = useForm({
    owner_name: props.settings.owner_name || '',
    owner_role: props.settings.owner_role || '',
    owner_bio: props.settings.owner_bio || '',
    location: props.settings.location || '',
    relocation_notice: props.settings.relocation_notice || '',
    email: props.settings.email || '',
    linkedin_url: props.settings.linkedin_url || '',
    github_url: props.settings.github_url || '',
    ai_assistant_welcome: props.settings.ai_assistant_welcome || '',
    meta_description: props.settings.meta_description || '',
    avatar: null,
    resume: null,
});

const onAvatarChange = (event) => {
    form.avatar = event.target.files[0];
};

const onResumeChange = (event) => {
    form.resume = event.target.files[0];
};

const saveSettings = () => {
    form.post('/admin/settings', {
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => {
            Swal.fire({
                title: 'Settings Saved!',
                text: 'Global site parameters updated successfully.',
                icon: 'success',
                confirmButtonColor: 'var(--accent-primary)',
                background: 'var(--bg-secondary)',
                color: 'var(--text-primary)',
            });
        },
        onError: () => {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please check the form fields for errors.',
                icon: 'error',
                confirmButtonColor: '#ef4444',
                background: 'var(--bg-secondary)',
                color: 'var(--text-primary)',
            });
        }
    });
};
</script>
