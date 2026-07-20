<template>
    <Head title="Projects Registry - Administrative Hub" />
    <AdminLayout>
        <!-- Title Header Bar -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h3 class="h4 font-mono text-primary-theme mb-1"><i class="fa-solid fa-briefcase text-accent me-2"></i>Projects Registry</h3>
                <p class="text-secondary-theme small font-sans mb-0">Add, edit, prioritize, or remove portfolio items from the database.</p>
            </div>
            <a href="/admin/projects/create" class="btn btn-custom btn-custom-primary font-sans">
                <i class="fa-solid fa-plus me-2"></i>Add New Project
            </a>
        </div>

        <!-- Listing card panel -->
        <div class="card-custom h-auto">
            <div class="table-responsive">
                <table class="table table-hover border-color align-middle font-sans m-0" style="background: transparent; color: var(--text-primary);">
                    <thead>
                        <tr class="text-secondary-theme font-mono small" style="border-bottom: 1px solid var(--border-color);">
                            <th scope="col" style="background: transparent; width: 60px;">SORT</th>
                            <th scope="col" style="background: transparent;">IMAGE</th>
                            <th scope="col" style="background: transparent;">TITLE</th>
                            <th scope="col" style="background: transparent;">CATEGORY</th>
                            <th scope="col" style="background: transparent;">STATUS</th>
                            <th scope="col" style="background: transparent;">FEATURED</th>
                            <th scope="col" class="text-end" style="background: transparent; width: 150px;">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="proj in projects" :key="proj.id">
                            <td class="font-mono text-secondary-theme small" style="background: transparent;">
                                #{{ proj.sort_order }}
                            </td>
                            <td style="background: transparent;">
                                <div class="rounded overflow-hidden" style="width: 48px; height: 32px; border: 1px solid var(--border-color);">
                                    <img :src="'/' + proj.image_path" class="w-100 h-100 object-fit-cover" alt="Thumb">
                                </div>
                            </td>
                            <td style="background: transparent;">
                                <div class="text-primary-theme fw-bold small">{{ proj.title }}</div>
                                <div class="text-secondary-theme text-xxs font-mono">{{ proj.slug }}</div>
                            </td>
                            <td style="background: transparent;">
                                <span class="text-accent text-xxs font-mono text-uppercase fw-bold">
                                    {{ proj.category }}
                                </span>
                            </td>
                            <td style="background: transparent;">
                                <span class="status-indicator-pill" :class="proj.status.toLowerCase()">
                                    <span class="status-dot"></span>{{ proj.status }}
                                </span>
                            </td>
                            <td style="background: transparent;">
                                <i v-if="proj.is_featured" class="fa-solid fa-star text-accent" title="Featured Portfolio Item"></i>
                                <span v-else class="text-secondary-theme font-mono text-xs">-</span>
                            </td>
                            <td class="text-end" style="background: transparent;">
                                <div class="d-flex justify-content-end gap-2">
                                    <a :href="`/admin/projects/${proj.id}/edit`" class="btn btn-custom btn-custom-outline btn-custom-xs px-2 py-1 font-mono">
                                        Edit
                                    </a>
                                    <button @click="deleteProject(proj)" class="btn btn-custom btn-custom-outline btn-custom-xs px-2 py-1 font-mono text-danger">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="projects.length === 0">
                            <td colspan="7" class="text-center text-secondary-theme py-5">
                                <i class="fa-solid fa-folder-open display-6 mb-3 text-muted"></i>
                                <p class="mb-0">No projects found in portfolio registry.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

defineProps({
    projects: Array,
});

const deleteProject = (proj) => {
    if (confirm(`Are you absolutely sure you want to delete project: "${proj.title}"? This cannot be undone.`)) {
        router.delete(`/admin/projects/${proj.id}`, {
            preserveScroll: true,
        });
    }
};
</script>
