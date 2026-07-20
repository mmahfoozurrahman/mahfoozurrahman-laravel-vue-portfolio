<template>
    <Head :title="isEdit ? 'Edit Project - Administrative Workspace' : 'Add New Project - Administrative Workspace'" />
    <AdminLayout>
        <!-- Back Navigation row -->
        <div class="mb-4">
            <a href="/admin/projects" class="btn btn-custom btn-custom-outline btn-custom-sm font-mono">
                <i class="fa-solid fa-arrow-left me-2"></i>Back to Projects
            </a>
        </div>

        <div class="card-custom h-auto max-width-lg mx-auto">
            <div class="border-bottom border-color pb-3 mb-4">
                <h3 class="h4 font-mono text-primary-theme mb-1">
                    <i class="fa-solid me-2" :class="isEdit ? 'fa-pen-to-square text-accent' : 'fa-square-plus text-accent'"></i>
                    {{ isEdit ? 'Edit Project: ' + project.title : 'Register New Project' }}
                </h3>
                <p class="text-secondary-theme small font-sans mb-0">Define project specifications, category listings, and visual assets paths.</p>
            </div>

            <!-- Form Wrapper -->
            <form @submit.prevent="submitForm">
                <div class="row g-4">
                    <!-- Title & Category -->
                    <div class="col-md-6">
                        <label for="title" class="form-label font-mono text-secondary-theme small">Project Title</label>
                        <input v-model="form.title" type="text" class="form-control contact-input" id="title" placeholder="Lilla Sushi">
                        <div v-if="form.errors.title" class="text-danger text-xxs font-mono mt-1">{{ form.errors.title }}</div>
                    </div>
                    <div class="col-md-6">
                        <label for="category" class="form-label font-mono text-secondary-theme small">Project Category</label>
                        <select v-model="form.category" class="form-select contact-input" id="category">
                            <option value="saas">SaaS Dashboard</option>
                            <option value="lms">LMS Hub</option>
                            <option value="restaurant">Restaurant Ordering</option>
                            <option value="pos">ERP & POS Software</option>
                            <option value="e-commerce">E-commerce Marketplace</option>
                            <option value="health">Healthcare Portal</option>
                            <option value="other">Utilities & Core Libraries</option>
                        </select>
                        <div v-if="form.errors.category" class="text-danger text-xxs font-mono mt-1">{{ form.errors.category }}</div>
                    </div>

                    <!-- Short Description -->
                    <div class="col-12">
                        <label for="description" class="form-label font-mono text-secondary-theme small">Short Description (Card Overview)</label>
                        <input v-model="form.description" type="text" class="form-control contact-input" id="description" placeholder="A high-performance live ordering app...">
                        <div v-if="form.errors.description" class="text-danger text-xxs font-mono mt-1">{{ form.errors.description }}</div>
                    </div>

                    <!-- Long Description -->
                    <div class="col-12">
                        <label for="long_description" class="form-label font-mono text-secondary-theme small">Long Description (Detailed Modal Showcase)</label>
                        <textarea v-model="form.long_description" class="form-control contact-input" id="long_description" rows="5" placeholder="Full-featured online food ordering ecosystem deployed for a client..."></textarea>
                        <div v-if="form.errors.long_description" class="text-danger text-xxs font-mono mt-1">{{ form.errors.long_description }}</div>
                    </div>

                    <!-- Status, Sorting order, Featured toggle -->
                    <div class="col-md-4">
                        <label for="status" class="form-label font-mono text-secondary-theme small">Project Status</label>
                        <select v-model="form.status" class="form-select contact-input" id="status">
                            <option value="COMPLETED">COMPLETED</option>
                            <option value="BUILDING">BUILDING</option>
                            <option value="PLANNED">PLANNED</option>
                        </select>
                        <div v-if="form.errors.status" class="text-danger text-xxs font-mono mt-1">{{ form.errors.status }}</div>
                    </div>
                    <div class="col-md-4">
                        <label for="sort_order" class="form-label font-mono text-secondary-theme small">Sort Priority Order</label>
                        <input v-model="form.sort_order" type="number" class="form-control contact-input" id="sort_order" placeholder="1">
                        <div v-if="form.errors.sort_order" class="text-danger text-xxs font-mono mt-1">{{ form.errors.sort_order }}</div>
                    </div>
                    <div class="col-md-4 d-flex align-items-center justify-content-start pt-4">
                        <div class="form-check form-switch">
                            <input v-model="form.is_featured" class="form-check-input" type="checkbox" id="is_featured">
                            <label class="form-check-label font-mono text-secondary-theme small ms-2" for="is_featured">Featured Showcase</label>
                        </div>
                    </div>

                    <!-- Comma separated Tech Stack tags -->
                    <div class="col-12">
                        <label for="tech_stack_input" class="form-label font-mono text-secondary-theme small">Tech Stack (comma-separated tags)</label>
                        <input v-model="techStackInput" type="text" class="form-control contact-input" id="tech_stack_input" placeholder="Laravel, Vue 3, Inertia.js, MySQL">
                        <div v-if="form.errors.tech_stack" class="text-danger text-xxs font-mono mt-1">{{ form.errors.tech_stack }}</div>
                        <div class="mt-2 d-flex flex-wrap gap-1">
                            <span v-for="(tag, idx) in previewStack" :key="idx" class="tech-badge">
                                {{ tag }}
                            </span>
                        </div>
                    </div>

                    <!-- Demo & GitHub URL parameters -->
                    <div class="col-md-6">
                        <label for="demo_url" class="form-label font-mono text-secondary-theme small">Live Demo Link</label>
                        <input v-model="form.demo_url" type="url" class="form-control contact-input" id="demo_url" placeholder="https://lillasushi.fr">
                        <div v-if="form.errors.demo_url" class="text-danger text-xxs font-mono mt-1">{{ form.errors.demo_url }}</div>
                    </div>
                    <div class="col-md-6">
                        <label for="github_url" class="form-label font-mono text-secondary-theme small">GitHub Repository Link</label>
                        <input v-model="form.github_url" type="url" class="form-control contact-input" id="github_url" placeholder="https://github.com/username/repo">
                        <div v-if="form.errors.github_url" class="text-danger text-xxs font-mono mt-1">{{ form.errors.github_url }}</div>
                    </div>

                    <!-- Preview screenshot upload -->
                    <div class="col-12">
                        <label for="image" class="form-label font-mono text-secondary-theme small">Upload Showcase Image Thumbnail (Max 2MB)</label>
                        <input @change="onImageChange" type="file" class="form-control contact-input" id="image" accept="image/*">
                        <div v-if="form.errors.image" class="text-danger text-xxs font-mono mt-1">{{ form.errors.image }}</div>
                        <div v-if="isEdit && project.image_path" class="text-secondary-theme text-xxs font-mono mt-1">Current file: {{ project.image_path }}</div>
                    </div>

                    <!-- Form Submissions Action Footer -->
                    <div class="col-12 border-top border-color mt-4 pt-3 d-flex justify-content-end gap-2">
                        <a href="/admin/projects" class="btn btn-custom btn-custom-outline btn-custom-xs px-4">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-custom btn-custom-primary px-5 py-3" :disabled="form.processing">
                            <span v-if="form.processing" class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
                            <i v-else class="fa-solid fa-circle-check me-2"></i>Save Project Entry
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
    project: Object,
});

const isEdit = computed(() => !!props.project);

// Parse dynamic initial tag list inputs
const techStackInput = ref(props.project ? props.project.tech_stack.join(', ') : '');

const previewStack = computed(() => {
    if (!techStackInput.value.trim()) return [];
    return techStackInput.value.split(',').map(s => s.trim()).filter(s => s !== '');
});

const form = useForm({
    title: props.project ? props.project.title : '',
    category: props.project ? props.project.category : 'saas',
    description: props.project ? props.project.description : '',
    long_description: props.project ? props.project.long_description : '',
    status: props.project ? props.project.status : 'COMPLETED',
    sort_order: props.project ? props.project.sort_order : 0,
    is_featured: props.project ? !!props.project.is_featured : false,
    tech_stack: [],
    demo_url: props.project ? props.project.demo_url : '',
    github_url: props.project ? props.project.github_url : '',
    image: null,
});

const onImageChange = (event) => {
    form.image = event.target.files[0];
};

const submitForm = () => {
    // Process string input into clean array tags
    form.tech_stack = previewStack.value;

    const requestOptions = {
        preserveScroll: true,
        forceFormData: true,
        onSuccess: () => {
            Swal.fire({
                title: 'Project Saved!',
                text: isEdit.value ? 'Showcase project updated successfully.' : 'New showcase project registered successfully.',
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
        form.put(`/admin/projects/${props.project.id}`, requestOptions);
    } else {
        form.post('/admin/projects', requestOptions);
    }
};
</script>
