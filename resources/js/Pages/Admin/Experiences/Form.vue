<template>
    <Head :title="isEdit ? 'Edit Role - Administrative Workspace' : 'Add New Role - Administrative Workspace'" />
    <AdminLayout>
        <!-- Back Navigation row -->
        <div class="mb-4">
            <a href="/admin/experiences" class="btn btn-custom btn-custom-outline btn-custom-sm font-mono">
                <i class="fa-solid fa-arrow-left me-2"></i>Back to Timeline
            </a>
        </div>

        <div class="card-custom h-auto max-width-lg mx-auto">
            <div class="border-bottom border-color pb-3 mb-4">
                <h3 class="h4 font-mono text-primary-theme mb-1">
                    <i class="fa-solid me-2" :class="isEdit ? 'fa-pen-to-square text-accent' : 'fa-square-plus text-accent'"></i>
                    {{ isEdit ? 'Edit Role: ' + experience.role_title : 'Register New Role Entry' }}
                </h3>
                <p class="text-secondary-theme small font-sans mb-0">Record role achievements, chronological dates, location tags, and technical stack parameters.</p>
            </div>

            <!-- Form Wrapper -->
            <form @submit.prevent="submitForm">
                <div class="row g-4">
                    <!-- Role Title & Company -->
                    <div class="col-md-6">
                        <label for="role_title" class="form-label font-mono text-secondary-theme small">Role Title</label>
                        <input v-model="form.role_title" type="text" class="form-control contact-input" id="role_title" placeholder="Senior Laravel Developer">
                        <div v-if="form.errors.role_title" class="text-danger text-xxs font-mono mt-1">{{ form.errors.role_title }}</div>
                    </div>
                    <div class="col-md-6">
                        <label for="company" class="form-label font-mono text-secondary-theme small">Company Name</label>
                        <input v-model="form.company" type="text" class="form-control contact-input" id="company" placeholder="Remote Development">
                        <div v-if="form.errors.company" class="text-danger text-xxs font-mono mt-1">{{ form.errors.company }}</div>
                    </div>

                    <!-- Location, Start Date, End Date -->
                    <div class="col-md-4">
                        <label for="location" class="form-label font-mono text-secondary-theme small">Location / Physical Office</label>
                        <input v-model="form.location" type="text" class="form-control contact-input" id="location" placeholder="Remote / Dhaka, Bangladesh">
                        <div v-if="form.errors.location" class="text-danger text-xxs font-mono mt-1">{{ form.errors.location }}</div>
                    </div>
                    <div class="col-md-4">
                        <label for="start_date" class="form-label font-mono text-secondary-theme small">Start Date / Year</label>
                        <input v-model="form.start_date" type="text" class="form-control contact-input" id="start_date" placeholder="2022">
                        <div v-if="form.errors.start_date" class="text-danger text-xxs font-mono mt-1">{{ form.errors.start_date }}</div>
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label font-mono text-secondary-theme small">End Date / Year</label>
                        <input v-model="form.end_date" type="text" class="form-control contact-input" id="end_date" placeholder="Present">
                        <div v-if="form.errors.end_date" class="text-danger text-xxs font-mono mt-1">{{ form.errors.end_date }}</div>
                    </div>

                    <!-- Sort Priority, Featured Toggle -->
                    <div class="col-md-6">
                        <label for="sort_order" class="form-label font-mono text-secondary-theme small">Sort Priority Order</label>
                        <input v-model="form.sort_order" type="number" class="form-control contact-input" id="sort_order" placeholder="1">
                        <div v-if="form.errors.sort_order" class="text-danger text-xxs font-mono mt-1">{{ form.errors.sort_order }}</div>
                    </div>
                    <div class="col-md-6 d-flex align-items-center justify-content-start pt-4">
                        <div class="form-check form-switch">
                            <input v-model="form.is_featured" class="form-check-input" type="checkbox" id="is_featured">
                            <label class="form-check-label font-mono text-secondary-theme small ms-2" for="is_featured">Featured Role Item</label>
                        </div>
                    </div>

                    <!-- Accomplishments array (New line text area) -->
                    <div class="col-12">
                        <label for="accomplishments_input" class="form-label font-mono text-secondary-theme small">Key Accomplishments (One bullet per line)</label>
                        <textarea v-model="accomplishmentsInput" class="form-control contact-input" id="accomplishments_input" rows="5" placeholder="Architect secure multi-tenant financial SaaS tools in Laravel.&#10;Design optimized database structures.&#10;Review source code structures."></textarea>
                        <div v-if="form.errors.accomplishments" class="text-danger text-xxs font-mono mt-1">{{ form.errors.accomplishments }}</div>
                        <ul class="mt-3 timeline-list" v-if="previewAccomplishments.length > 0">
                            <li v-for="(item, idx) in previewAccomplishments" :key="idx" class="small text-secondary-theme font-sans mb-1">
                                {{ item }}
                            </li>
                        </ul>
                    </div>

                    <!-- Comma separated skills -->
                    <div class="col-12">
                        <label for="skills_input" class="form-label font-mono text-secondary-theme small">Associated Skills / Technologies (comma-separated)</label>
                        <input v-model="skillsInput" type="text" class="form-control contact-input" id="skills_input" placeholder="Laravel, Vue 3, Inertia.js, MySQL, Redis, Docker">
                        <div v-if="form.errors.skills" class="text-danger text-xxs font-mono mt-1">{{ form.errors.skills }}</div>
                        <div class="mt-2 d-flex flex-wrap gap-1">
                            <span v-for="(skill, idx) in previewSkills" :key="idx" class="tech-badge">
                                {{ skill }}
                            </span>
                        </div>
                    </div>

                    <!-- Role Icon/Preview photo upload -->
                    <div class="col-12">
                        <label for="image" class="form-label font-mono text-secondary-theme small">Upload Showcase Icon / Image (Max 2MB)</label>
                        <input @change="onImageChange" type="file" class="form-control contact-input" id="image" accept="image/*">
                        <div v-if="form.errors.image" class="text-danger text-xxs font-mono mt-1">{{ form.errors.image }}</div>
                        <div v-if="isEdit && experience.image_path" class="text-secondary-theme text-xxs font-mono mt-1">Current file: {{ experience.image_path }}</div>
                    </div>

                    <!-- Form Submissions Action Footer -->
                    <div class="col-12 border-top border-color mt-4 pt-3 d-flex justify-content-end gap-2">
                        <a href="/admin/experiences" class="btn btn-custom btn-custom-outline btn-custom-xs px-4">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-custom btn-custom-primary px-5 py-3" :disabled="form.processing">
                            <span v-if="form.processing" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                            <i v-else class="fa-solid fa-circle-check me-2"></i>Save Role Entry
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

const props = defineProps({
    experience: Object,
});

const isEdit = computed(() => !!props.experience);

// Bind array to direct editable strings
const accomplishmentsInput = ref(props.experience ? props.experience.accomplishments.join('\n') : '');
const skillsInput = ref(props.experience ? props.experience.skills.join(', ') : '');

const previewAccomplishments = computed(() => {
    if (!accomplishmentsInput.value.trim()) return [];
    return accomplishmentsInput.value.split('\n').map(s => s.trim()).filter(s => s !== '');
});

const previewSkills = computed(() => {
    if (!skillsInput.value.trim()) return [];
    return skillsInput.value.split(',').map(s => s.trim()).filter(s => s !== '');
});

const form = useForm({
    role_title: props.experience ? props.experience.role_title : '',
    company: props.experience ? props.experience.company : '',
    location: props.experience ? props.experience.location : '',
    start_date: props.experience ? props.experience.start_date : '',
    end_date: props.experience ? props.experience.end_date : '',
    sort_order: props.experience ? props.experience.sort_order : 0,
    is_featured: props.experience ? !!props.experience.is_featured : false,
    accomplishments: [],
    skills: [],
    image: null,
});

const onImageChange = (event) => {
    form.image = event.target.files[0];
};

const submitForm = () => {
    // Inject processed lists
    form.accomplishments = previewAccomplishments.value;
    form.skills = previewSkills.value;

    const requestOptions = {
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => {
            Swal.fire({
                title: 'Role Saved!',
                text: isEdit.value ? 'Timeline record updated successfully.' : 'New timeline record registered successfully.',
                icon: 'success',
                confirmButtonColor: 'var(--accent-primary)',
                background: 'var(--bg-secondary)',
                color: 'var(--text-primary)',
            });
        },
        onError: () => {
            Swal.fire({
                title: 'Validation Error!',
                text: 'Please review all mandatory fields and format requirements.',
                icon: 'error',
                confirmButtonColor: '#ef4444',
                background: 'var(--bg-secondary)',
                color: 'var(--text-primary)',
            });
        }
    };

    if (isEdit.value) {
        form.post(`/admin/experiences/${props.experience.id}`, {
            ...requestOptions,
            _method: 'PUT',
        });
    } else {
        form.post('/admin/experiences', requestOptions);
    }
};
</script>
