<template>
    <Head title="Work History Registry - Administrative Hub" />
    <AdminLayout>
        <!-- Title Header Bar -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h3 class="h4 font-mono text-primary-theme mb-1"><i class="fa-solid fa-timeline text-accent me-2"></i>Experience Timeline</h3>
                <p class="text-secondary-theme small font-sans mb-0">Record and chronologically order your professional career timeline items.</p>
            </div>
            <a href="/admin/experiences/create" class="btn btn-custom btn-custom-primary font-sans">
                <i class="fa-solid fa-plus me-2"></i>Add New Role
            </a>
        </div>

        <!-- Listing card panel -->
        <div class="card-custom h-auto">
            <div class="table-responsive">
                <table class="table table-hover border-color align-middle font-sans m-0" style="background: transparent; color: var(--text-primary);">
                    <thead>
                        <tr class="text-secondary-theme font-mono small" style="border-bottom: 1px solid var(--border-color);">
                            <th scope="col" style="background: transparent; width: 60px;">SORT</th>
                            <th scope="col" style="background: transparent;">COMPANY</th>
                            <th scope="col" style="background: transparent;">ROLE TITLE</th>
                            <th scope="col" style="background: transparent;">TIMELINE</th>
                            <th scope="col" style="background: transparent;">LOCATION</th>
                            <th scope="col" style="background: transparent;">FEATURED</th>
                            <th scope="col" class="text-end" style="background: transparent; width: 150px;">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="exp in experiences" :key="exp.id">
                            <td class="font-mono text-secondary-theme small" style="background: transparent;">
                                #{{ exp.sort_order }}
                            </td>
                            <td style="background: transparent;">
                                <div class="text-primary-theme fw-bold small">{{ exp.company }}</div>
                            </td>
                            <td style="background: transparent;">
                                <div class="text-primary-theme fw-semibold small">{{ exp.role_title }}</div>
                            </td>
                            <td class="font-mono text-secondary-theme small" style="background: transparent;">
                                {{ exp.start_date }} - {{ exp.end_date }}
                            </td>
                            <td class="text-secondary-theme small" style="background: transparent;">
                                {{ exp.location || 'Remote' }}
                            </td>
                            <td style="background: transparent;">
                                <i v-if="exp.is_featured" class="fa-solid fa-circle-check text-accent" title="Featured Role"></i>
                                <span v-else class="text-secondary-theme font-mono text-xs">-</span>
                            </td>
                            <td class="text-end" style="background: transparent;">
                                <div class="d-flex justify-content-end gap-2">
                                    <a :href="`/admin/experiences/${exp.id}/edit`" class="btn btn-custom btn-custom-outline btn-custom-xs px-2 py-1 font-mono">
                                        Edit
                                    </a>
                                    <button @click="deleteExperience(exp)" class="btn btn-custom btn-custom-outline btn-custom-xs px-2 py-1 font-mono text-danger">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="experiences.length === 0">
                            <td colspan="7" class="text-center text-secondary-theme py-5">
                                <i class="fa-solid fa-folder-open display-6 mb-3 text-muted"></i>
                                <p class="mb-0">No experiences found in work history registry.</p>
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
    experiences: Array,
});

const deleteExperience = (exp) => {
    if (confirm(`Are you absolutely sure you want to delete experience: "${exp.role_title} at ${exp.company}"?`)) {
        router.delete(`/admin/experiences/${exp.id}`, {
            preserveScroll: true,
        });
    }
};
</script>
