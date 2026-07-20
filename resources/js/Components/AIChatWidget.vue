<template>
    <div>
        <!-- Floating Chat Toggle Trigger Button -->
        <button @click="toggleChat" class="ai-chat-trigger" :class="{ 'active': isOpen }" id="chatTrigger"
            :title="isOpen ? 'Close AI Twin Assistant' : 'Chat with AI Twin Assistant'"
            :aria-label="isOpen ? 'Close AI Twin Assistant' : 'Chat with AI Twin Assistant'">
            <i :class="isOpen ? 'fa-solid fa-xmark' : 'fa-solid fa-robot'"></i>
        </button>

        <!-- Floating Chat Box Panel -->
        <div class="ai-chat-panel" :class="{ 'active': isOpen }">
            <!-- Header -->
            <div class="chat-header">
                <div class="chat-header-info">
                    <div class="chat-header-avatar">
                        <i class="fa-solid fa-robot"></i>
                    </div>
                    <div>
                        <h4 class="chat-header-title text-white">Mahfoozur's Twin</h4>
                        <span class="chat-header-status">Online</span>
                    </div>
                </div>
                <button @click="toggleChat" class="chat-close-btn" aria-label="Close Chat">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Chat Window Messages List -->
            <div class="chat-body" ref="messagesContainer">
                <div v-for="(msg, index) in messages" :key="index"
                    class="chat-message" :class="msg.sender === 'user' ? 'chat-message-user' : 'chat-message-bot'">
                    <div class="message-text">{{ msg.text }}</div>
                </div>

                <!-- Bot Typing Indicator -->
                <div v-if="isTyping" class="chat-message chat-message-bot">
                    <div class="typing-indicator d-flex gap-1 py-1">
                        <span class="spinner-grow spinner-grow-sm text-accent" style="width: 6px; height: 6px;" role="status"></span>
                        <span class="spinner-grow spinner-grow-sm text-accent" style="width: 6px; height: 6px; animation-delay: 0.2s;" role="status"></span>
                        <span class="spinner-grow spinner-grow-sm text-accent" style="width: 6px; height: 6px; animation-delay: 0.4s;" role="status"></span>
                    </div>
                </div>
            </div>

            <!-- Quick Conversation Starters -->
            <div v-if="messages.length <= 1" class="p-2 d-flex flex-wrap gap-1 bg-secondary border-top border-color">
                <button v-for="(starter, idx) in starters" :key="idx" @click="sendStarter(starter)"
                    class="filter-btn py-1 px-2 text-xxs font-mono" style="font-size: 0.72rem;">
                    {{ starter }}
                </button>
            </div>

            <!-- Chat Input Footer -->
            <div class="chat-footer">
                <div class="chat-input-group">
                    <input v-model="userInput" @keyup.enter="sendMessage" type="text"
                        placeholder="Ask about tech stack or visa..." class="chat-input-field"
                        :disabled="isTyping" />
                    <button @click="sendMessage" class="chat-send-btn" :disabled="!userInput.trim() || isTyping"
                        aria-label="Send Message">
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, nextTick, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const settings = computed(() => page.props.settings || {});

const isOpen = ref(false);
const userInput = ref('');
const isTyping = ref(false);
const messagesContainer = ref(null);

const messages = ref([
    {
        sender: 'bot',
        text: 'Hello! I am Mahfoozur\'s digital twin. Ask me anything about my tech stack, Tokyo relocation eligibility, or SaaS project architecture!',
        time: formatTime(new Date()),
    }
]);

const starters = [
    'Japan Visa Eligibility?',
    'Primary Tech Stack?',
    'SaaS POS Project?',
    'Contact Info?',
];

function toggleChat() {
    isOpen.value = !isOpen.value;
    if (isOpen.value) {
        scrollToBottom();
    }
}

function formatTime(date) {
    return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
}

function scrollToBottom() {
    nextTick(() => {
        if (messagesContainer.value) {
            messagesContainer.value.scrollTop = messagesContainer.value.scrollHeight;
        }
    });
}

function sendStarter(starter) {
    userInput.value = starter;
    sendMessage();
}

function sendMessage() {
    const text = userInput.value.trim();
    if (!text || isTyping.value) return;

    // Log User Message
    messages.value.push({
        sender: 'user',
        text: text,
        time: formatTime(new Date()),
    });
    userInput.value = '';
    scrollToBottom();

    // Trigger Bot typing
    isTyping.value = true;
    scrollToBottom();

    // Simulate AI response response loop
    setTimeout(async () => {
        isTyping.value = false;
        const reply = await getAIResponse(text);
        messages.value.push({
            sender: 'bot',
            text: reply,
            time: formatTime(new Date()),
        });
        scrollToBottom();
    }, 1000);
}

async function getAIResponse(query) {
    const lower = query.toLowerCase();

    // Smart Local Expert Matching (Zero Latency)
    if (lower.includes('relocation') || lower.includes('japan') || lower.includes('tokyo') || lower.includes('osaka') || lower.includes('visa')) {
        return settings.value.relocation_notice || 'I am highly open to remote full-time contracts and relocation to Tokyo or Osaka, Japan. I am fully eligible for Engineer Visa sponsorship.';
    }
    if (lower.includes('stack') || lower.includes('skill') || lower.includes('technology') || lower.includes('framework')) {
        return 'Mahfoozur\'s primary stack is Laravel, Inertia.js, Vue 3, Plain PHP, and MySQL. He is also highly skilled in CSS customization, POS/CRM tools, API design, Docker, Git, and automated testing frameworks.';
    }
    if (lower.includes('sushi') || lower.includes('lilla')) {
        return 'Lilla Sushi is a live, high-performance online restaurant ordering system operating in France. Deployed using Laravel, Vue 3, and Inertia.js, it interfaces with a real-time order-fulfillment tablet system for merchants.';
    }
    if (lower.includes('saas') || lower.includes('pos') || lower.includes('billing')) {
        return 'He has architected multiple SaaS platforms, including a multi-tenant Loan & Investment dashboard featuring total ledger separation, and an ISP Billing Tracker with automated bandwidth controls linked to MikroTik routers.';
    }
    if (lower.includes('contact') || lower.includes('email') || lower.includes('hire')) {
        return `You can reach Mahfoozur directly via email at ${settings.value.email || 'mahfoozur.rahman@example.com'} or submit your details in the Contact form. He's looking forward to speaking with you!`;
    }

    // Dynamic fallback prompt
    return 'That is a great question! Mahfoozur has nearly a decade of experience shipping robust backend products in Laravel, Inertia, and CakePHP. Feel free to shoot him an email at ' + (settings.value.email || 'mahfoozur.rahman@example.com') + ' to chat more!';
}
</script>
