<template>
    <Head title="Connect Messages Inbox - Administrative Workspace" />
    <AdminLayout>
        <!-- Title Header Bar -->
        <div class="mb-4">
            <h3 class="h4 font-mono text-primary-theme mb-1"><i class="fa-solid fa-inbox text-accent me-2"></i>Inquiries Inbox</h3>
            <p class="text-secondary-theme small font-sans mb-0">Review questions, sponsorship proposals, or job inquiries sent via the contact page.</p>
        </div>

        <!-- Messaging Registry panel -->
        <div class="card-custom h-auto">
            <div class="table-responsive">
                <table class="table table-hover border-color align-middle font-sans m-0" style="background: transparent; color: var(--text-primary);">
                    <thead>
                        <tr class="text-secondary-theme font-mono small" style="border-bottom: 1px solid var(--border-color);">
                            <th scope="col" style="background: transparent; width: 120px;">STATUS</th>
                            <th scope="col" style="background: transparent;">SENDER</th>
                            <th scope="col" style="background: transparent;">SUBJECT</th>
                            <th scope="col" style="background: transparent;">DATE RECEIVED</th>
                            <th scope="col" class="text-end" style="background: transparent; width: 220px;">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="msg in messages" :key="msg.id" :style="msg.status === 'unread' ? 'font-weight: 500; background-color: rgba(242, 161, 27, 0.01);' : ''">
                            <!-- Status Badges -->
                            <td style="background: transparent;">
                                <span class="status-indicator-pill" :class="msg.status === 'unread' ? 'planned' : msg.status === 'archived' ? 'building' : 'completed'">
                                    <span class="status-dot"></span>{{ msg.status }}
                                </span>
                            </td>
                            
                            <!-- Sender details -->
                            <td style="background: transparent;">
                                <div class="text-primary-theme fw-bold small">{{ msg.name }}</div>
                                <div class="text-secondary-theme text-xxs font-mono">{{ msg.email }}</div>
                            </td>

                            <!-- Subject summary -->
                            <td class="small text-secondary-theme" style="background: transparent; max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ msg.subject }}
                            </td>

                            <!-- Date time -->
                            <td class="font-mono text-secondary-theme text-xs" style="background: transparent;">
                                {{ formatDate(msg.created_at) }}
                            </td>

                            <!-- Action button groups -->
                            <td class="text-end" style="background: transparent;">
                                <div class="d-flex justify-content-end gap-2">
                                    <button @click="openMessage(msg)" class="btn btn-custom btn-custom-outline btn-custom-xs px-2 py-1 font-mono">
                                        Open
                                    </button>
                                    <button v-if="msg.status !== 'archived'" @click="archiveMessage(msg)" class="btn btn-custom btn-custom-outline btn-custom-xs px-2 py-1 font-mono text-warning">
                                        Archive
                                    </button>
                                    <button @click="deleteMessage(msg)" class="btn btn-custom btn-custom-outline btn-custom-xs px-2 py-1 font-mono text-danger">
                                        Delete
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="messages.length === 0">
                            <td colspan="5" class="text-center text-secondary-theme py-5">
                                <i class="fa-solid fa-envelope-open display-6 mb-3 text-muted"></i>
                                <p class="mb-0">Inbox is empty. No messages found in database.</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Glassmorphic Details Viewer Modal Overlay -->
        <div v-if="activeMessage" class="modal-overlay" @click.self="closeMessage">
            <div class="modal-card card-custom p-0 overflow-hidden" data-aos="zoom-in" data-aos-duration="300" style="max-width: 650px;">
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
                            <span class="font-mono text-secondary-theme text-xxs d-block">SENDER NAME</span>
                            <div class="text-primary-theme fw-bold">{{ activeMessage.name }}</div>
                        </div>
                        <div class="col-md-6">
                            <span class="font-mono text-secondary-theme text-xxs d-block">SENDER EMAIL</span>
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

                    <!-- Modal Actions footer -->
                    <div class="border-top border-color mt-4 pt-3 d-flex justify-content-end gap-2">
                        <a :href="'mailto:' + activeMessage.email + '?subject=Re: ' + activeMessage.subject" class="btn btn-custom btn-custom-primary btn-custom-xs px-3">
                            <i class="fa-solid fa-reply me-1"></i>Reply via Mail
                        </a>
                        <button v-if="activeMessage.status !== 'archived'" @click="archiveMessage(activeMessage); closeMessage()" class="btn btn-custom btn-custom-outline btn-custom-xs px-3 text-warning">
                            Archive Message
                        </button>
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
import { ref } from 'vue';
import { Head, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

const props = defineProps({
    messages: Array,
});

const activeMessage = ref(null);

const openMessage = (msg) => {
    activeMessage.value = msg;
    
    // Auto mark read via standard Inertia reload triggers
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

const archiveMessage = (msg) => {
    router.post(`/admin/messages/${msg.id}/archive`, {}, {
        preserveScroll: true,
        onSuccess: () => {
            msg.status = 'archived';
        }
    });
};

const deleteMessage = (msg) => {
    if (confirm(`Are you absolutely sure you want to delete message from: "${msg.name}"?`)) {
        router.delete(`/admin/messages/${msg.id}`, {
            preserveScroll: true,
            onSuccess: () => {
                if (activeMessage.value && activeMessage.value.id === msg.id) {
                    closeMessage();
                }
            }
        });
    }
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
