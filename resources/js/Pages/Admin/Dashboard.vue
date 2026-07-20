<template>
    <Head title="Admin Dashboard - Work Center" />
    <AdminLayout>
        <!-- Welcome Jumbotron Banner -->
        <div class="card-custom mb-4 p-4 position-relative overflow-hidden h-auto" style="background: linear-gradient(135deg, var(--bg-secondary) 0%, rgba(242, 161, 27, 0.05) 100%);">
            <h1 class="display-6 fw-bold text-gradient font-mono">Welcome back, Mahfoozur</h1>
            <p class="text-secondary-theme mb-0 font-sans mt-2" style="max-width: 600px;">
                Manage your professional portfolio variables, adjust site announcements, track recent subscriber inbox messages, and maintain your AI twin expert ruleset.
            </p>
        </div>

        <!-- Metrics Visual Grid -->
        <div class="row g-4 mb-4">
            <!-- Projects metric -->
            <div class="col-sm-6 col-xl-3">
                <div class="card-custom p-4 d-flex align-items-center gap-3">
                    <div class="contact-info-icon" style="background: var(--bg-tertiary); color: var(--accent-primary);">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <div>
                        <span class="font-mono text-secondary-theme text-xxs d-block text-uppercase">PROJECTS REGISTERED</span>
                        <h3 class="h3 fw-bold mb-0 text-primary-theme font-mono mt-1">{{ metrics.total_projects }}</h3>
                    </div>
                </div>
            </div>

            <!-- Experiences metric -->
            <div class="col-sm-6 col-xl-3">
                <div class="card-custom p-4 d-flex align-items-center gap-3">
                    <div class="contact-info-icon" style="background: var(--bg-tertiary); color: var(--accent-primary);">
                        <i class="fa-solid fa-timeline"></i>
                    </div>
                    <div>
                        <span class="font-mono text-secondary-theme text-xxs d-block text-uppercase">ROLES TIMELINE</span>
                        <h3 class="h3 fw-bold mb-0 text-primary-theme font-mono mt-1">{{ metrics.total_experiences }}</h3>
                    </div>
                </div>
            </div>

            <!-- Total Messages metric -->
            <div class="col-sm-6 col-xl-3">
                <div class="card-custom p-4 d-flex align-items-center gap-3">
                    <div class="contact-info-icon" style="background: var(--bg-tertiary); color: var(--accent-primary);">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <span class="font-mono text-secondary-theme text-xxs d-block text-uppercase">TOTAL INQUIRIES</span>
                        <h3 class="h3 fw-bold mb-0 text-primary-theme font-mono mt-1">{{ metrics.total_messages }}</h3>
                    </div>
                </div>
            </div>

            <!-- Unread Messages alert metric -->
            <div class="col-sm-6 col-xl-3">
                <div class="card-custom p-4 d-flex align-items-center gap-3" :style="metrics.unread_messages > 0 ? 'border-color: var(--accent-primary);' : ''">
                    <div class="contact-info-icon" :style="metrics.unread_messages > 0 ? 'background: rgba(242, 161, 27, 0.1); color: var(--accent-primary);' : 'background: var(--bg-tertiary); color: var(--text-secondary);'">
                        <i class="fa-solid fa-bell" :class="{ 'pulseGlow': metrics.unread_messages > 0 }"></i>
                    </div>
                    <div>
                        <span class="font-mono text-secondary-theme text-xxs d-block text-uppercase">UNREAD MESSAGES</span>
                        <h3 class="h3 fw-bold mb-0 font-mono mt-1" :class="metrics.unread_messages > 0 ? 'text-accent' : 'text-primary-theme'">
                            {{ metrics.unread_messages }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Left Column: Recent Messages -->
            <div class="col-lg-8">
                <div class="card-custom h-100">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="h5 font-mono mb-0 text-primary-theme"><i class="fa-solid fa-inbox text-accent me-2"></i>Recent Messages Inbox</h3>
                        <a href="/admin/messages" class="btn btn-custom btn-custom-outline btn-custom-sm font-sans">
                            View All Messages
                        </a>
                    </div>

                    <!-- Inbox List -->
                    <div class="table-responsive">
                        <table class="table table-hover border-color align-middle font-sans m-0" style="background: transparent; color: var(--text-primary);">
                            <thead>
                                <tr class="text-secondary-theme font-mono small" style="border-bottom: 1px solid var(--border-color);">
                                    <th scope="col" style="background: transparent;">SENDER</th>
                                    <th scope="col" style="background: transparent;">SUBJECT</th>
                                    <th scope="col" style="background: transparent;">DATE</th>
                                    <th scope="col" class="text-end" style="background: transparent;">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="msg in recentMessages" :key="msg.id" :style="msg.status === 'unread' ? 'font-weight: 500; background-color: rgba(242, 161, 27, 0.02);' : ''">
                                    <td style="background: transparent;">
                                        <div class="d-flex align-items-center gap-2">
                                            <span v-if="msg.status === 'unread'" class="location-dot" style="width: 6px; height: 6px;"></span>
                                            <div class="text-primary-theme small">{{ msg.name }}</div>
                                        </div>
                                        <div class="text-secondary-theme text-xxs">{{ msg.email }}</div>
                                    </td>
                                    <td class="small text-secondary-theme" style="background: transparent; max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        {{ msg.subject }}
                                    </td>
                                    <td class="font-mono text-secondary-theme text-xs" style="background: transparent;">
                                        {{ formatDate(msg.created_at) }}
                                    </td>
                                    <td class="text-end" style="background: transparent;">
                                        <button @click="openMessage(msg)" class="btn btn-custom btn-custom-outline btn-custom-xs px-2 py-1 font-mono">
                                            Open
                                        </button>
                                    </td>
                                </tr>
                                <tr v-if="recentMessages.length === 0">
                                    <td colspan="4" class="text-center text-secondary-theme py-5">
                                        <i class="fa-solid fa-folder-open display-6 mb-3 text-muted"></i>
                                        <p class="mb-0">No inbox messages found in workspace.</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Column: Quick Shortcuts -->
            <div class="col-lg-4">
                <div class="card-custom d-flex flex-column gap-4 h-100">
                    <h3 class="h5 font-mono mb-0 text-primary-theme"><i class="fa-solid fa-signs-post text-accent me-2"></i>Quick Actions</h3>
                    
                    <div class="d-flex flex-column gap-3">
                        <a href="/admin/settings" class="btn btn-custom btn-custom-outline w-100 text-start py-3 d-flex align-items-center justify-content-between">
                            <span><i class="fa-solid fa-sliders text-accent me-3"></i>Site Settings Panel</span>
                            <i class="fa-solid fa-chevron-right text-muted small"></i>
                        </a>

                        <a href="/admin/projects/create" class="btn btn-custom btn-custom-outline w-100 text-start py-3 d-flex align-items-center justify-content-between">
                            <span><i class="fa-solid fa-square-plus text-accent me-3"></i>Register New Project</span>
                            <i class="fa-solid fa-chevron-right text-muted small"></i>
                        </a>

                        <a href="/admin/experiences/create" class="btn btn-custom btn-custom-outline w-100 text-start py-3 d-flex align-items-center justify-content-between">
                            <span><i class="fa-solid fa-calendar-plus text-accent me-3"></i>Register Work History</span>
                            <i class="fa-solid fa-chevron-right text-muted small"></i>
                        </a>
                    </div>

                    <!-- AI Status Snippet -->
                    <div class="card-custom bg-secondary p-3 mt-auto border-color">
                        <div class="d-flex align-items-center gap-3">
                            <div class="contact-info-icon" style="width: 36px; height: 36px; font-size: 0.95rem;">
                                <i class="fa-solid fa-robot"></i>
                            </div>
                            <div>
                                <h6 class="text-primary-theme text-xs font-mono mb-1">AI Assistant Ruleset</h6>
                                <span class="text-success text-xxs font-mono">Status: ACTIVE</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Details Viewer Modal Overlay -->
        <div v-if="activeMessage" class="modal-overlay" @click.self="closeMessage">
            <div class="modal-card card-custom p-0 overflow-hidden" data-aos="zoom-in" data-aos-duration="300" style="max-width: 600px;">
                <div class="portfolio-thumb" style="height: auto; padding: 1.5rem;">
                    <div class="thumb-header d-flex justify-content-between align-items-center">
                        <h4 class="h5 font-mono mb-0 text-primary-theme"><i class="fa-solid fa-envelope-open text-accent me-2"></i>Inquiry message</h4>
                        <button @click="closeMessage" class="btn-modal-close" aria-label="Close Modal">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>

                <div class="p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <span class="font-mono text-secondary-theme text-xxs d-block">SENDER</span>
                            <div class="text-primary-theme fw-bold">{{ activeMessage.name }}</div>
                        </div>
                        <div class="col-md-6">
                            <span class="font-mono text-secondary-theme text-xxs d-block">EMAIL ADDRESS</span>
                            <a :href="'mailto:' + activeMessage.email" class="text-primary font-mono fw-semibold">{{ activeMessage.email }}</a>
                        </div>
                        <div class="col-12 border-top border-color pt-3">
                            <span class="font-mono text-secondary-theme text-xxs d-block">SUBJECT</span>
                            <div class="text-primary-theme small fw-semibold font-mono">{{ activeMessage.subject }}</div>
                        </div>
                        <div class="col-12 border-top border-color pt-3">
                            <span class="font-mono text-secondary-theme text-xxs d-block">MESSAGE BODY</span>
                            <p class="text-secondary-theme small font-mono mt-2 bg-secondary p-3 rounded border border-color" style="white-space: pre-line; line-height: 1.6;">
                                {{ activeMessage.message }}
                            </p>
                        </div>
                    </div>

                    <div class="border-top border-color mt-4 pt-3 d-flex justify-content-end gap-2">
                        <a :href="'mailto:' + activeMessage.email + '?subject=Re: ' + activeMessage.subject" class="btn btn-custom btn-custom-primary btn-custom-xs px-3">
                            <i class="fa-solid fa-reply me-1"></i>Reply via Mail
                        </a>
                        <button @click="closeMessage" class="btn btn-custom btn-custom-outline btn-custom-xs px-3">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '../../Layouts/AdminLayout.vue';

const props = defineProps({
    metrics: Object,
    recent_messages: Array,
});

const recentMessages = computed(() => props.recent_messages || []);

const activeMessage = ref(null);

const openMessage = (msg) => {
    activeMessage.value = msg;
    
    // If opening an unread message, dynamically dispatch update to mark it read on server
    if (msg.status === 'unread') {
        router.post(`/admin/messages/${msg.id}/mark-read`, {}, {
            preserveScroll: true,
            onSuccess: () => {
                msg.status = 'read';
            }
        });
    }
};

const closeMessage = () => {
    activeMessage.value = null;
};

const formatDate = (dateString) => {
    const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    return new Date(dateString).toLocaleDateString('en-US', options);
};
</script>

<style scoped>
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(10, 16, 26, 0.75);
    backdrop-filter: blur(15px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    padding: 1.5rem;
}

.modal-card {
    width: 100%;
    background: var(--bg-secondary);
    border: 1px solid var(--border-color);
    animation: scaleUp 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.btn-modal-close {
    background: transparent;
    border: none;
    color: var(--text-secondary);
    font-size: 1.25rem;
    cursor: pointer;
    transition: color 0.2s;
}

.btn-modal-close:hover {
    color: var(--accent-primary);
}

@keyframes scaleUp {
    from { transform: scale(0.9); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}
</style>
