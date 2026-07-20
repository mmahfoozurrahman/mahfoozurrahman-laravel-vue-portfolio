document.addEventListener('DOMContentLoaded', () => {
    // ==========================================
    // 1. LIGHT / DARK THEME TOGGLE
    // ==========================================
    const themeToggleBtn = document.getElementById('theme-toggle');
    
    // Determine the user's preferred theme
    const getPreferredTheme = () => {
        const storedTheme = localStorage.getItem('theme');
        if (storedTheme) {
            return storedTheme;
        }
        return window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
    };

    // Apply the specified theme
    const applyTheme = (theme) => {
        const icon = themeToggleBtn.querySelector('i');
        if (theme === 'light') {
            document.body.classList.add('light-mode');
            if (icon) {
                icon.className = 'fa-solid fa-sun';
            }
            localStorage.setItem('theme', 'light');
        } else {
            document.body.classList.remove('light-mode');
            if (icon) {
                icon.className = 'fa-solid fa-moon';
            }
            localStorage.setItem('theme', 'dark');
        }
    };

    // Initialize Theme
    const currentTheme = getPreferredTheme();
    applyTheme(currentTheme);

    // Event listener for theme toggle click
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            const isLight = document.body.classList.contains('light-mode');
            applyTheme(isLight ? 'dark' : 'light');
        });
    }

    // ==========================================
    // 2. ACTIVE NAVBAR LINK HIGHLIGHTING
    // ==========================================
    const currentPath = window.location.pathname.split('/').pop() || 'index.html';
    const navLinks = document.querySelectorAll('.navbar-custom .nav-link');
    
    navLinks.forEach(link => {
        const linkPath = link.getAttribute('href');
        if (linkPath === currentPath) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });

    // ==========================================
    // 3. AOS (ANIMATION ON SCROLL) INITIALIZATION
    // ==========================================
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-out-quad',
            delay: 50
        });
    }

    // ==========================================
    // 4. PORTFOLIO FILTER SYSTEM
    // ==========================================
    const filterButtons = document.querySelectorAll('.filter-btn');
    const portfolioCards = document.querySelectorAll('.portfolio-item');

    if (filterButtons.length > 0 && portfolioCards.length > 0) {
        filterButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                // Set active filter button
                filterButtons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const filterValue = btn.getAttribute('data-filter');

                portfolioCards.forEach(card => {
                    const cardCategory = card.getAttribute('data-category');
                    
                    if (filterValue === 'all' || cardCategory === filterValue) {
                        card.style.display = 'block';
                        // Trigger AOS animation or standard fade in
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'scale(1)';
                        }, 50);
                    } else {
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.95)';
                        setTimeout(() => {
                            card.style.display = 'none';
                        }, 250); // Match transition duration
                    }
                });
            });
        });
    }

    // ==========================================
    // 5. FLOATING AI CHAT WIDGET BEHAVIORS
    // ==========================================
    const chatTrigger = document.getElementById('ai-chat-trigger');
    const chatPanel = document.getElementById('ai-chat-panel');
    const chatCloseBtn = document.getElementById('chat-close');
    const chatSendBtn = document.getElementById('chat-send');
    const chatInput = document.getElementById('chat-input');
    const chatBody = document.getElementById('chat-body');

    // Toggle Chat Panel
    if (chatTrigger && chatPanel) {
        chatTrigger.addEventListener('click', () => {
            chatPanel.classList.toggle('active');
            if (chatPanel.classList.contains('active')) {
                chatInput.focus();
                // Scroll chat body to bottom
                chatBody.scrollTop = chatBody.scrollHeight;
            }
        });
    }

    // Close Chat Panel
    if (chatCloseBtn && chatPanel) {
        chatCloseBtn.addEventListener('click', () => {
            chatPanel.classList.remove('active');
        });
    }

    // Trigger AI Chat Widget from Page Sections (e.g. Contact Me page)
    const pageChatTrigger = document.getElementById('start-ai-chat');
    if (pageChatTrigger) {
        pageChatTrigger.addEventListener('click', (e) => {
            e.preventDefault();
            if (chatPanel) {
                chatPanel.classList.add('active');
                chatInput.focus();
                chatBody.scrollTop = chatBody.scrollHeight;
            }
        });
    }

    // Pre-canned AI Responses for Mock Chat
    const mockResponses = [
        "That's an excellent question! Tusher (Mahfoozur) has about 10 years of self-taught web experience. His primary strengths are Laravel, Inertia.js, and Vue 3.",
        "Yes, Tusher is highly interested in relocating to Japan! He is ready to relocate on an Engineer Visa and is open to full-remote options as well.",
        "Tusher's stack includes: Laravel, Inertia.js, Vue 3, MySQL, CakePHP, Plain PHP MVC, ASP.NET Core, and Power BI.",
        "He is currently building a hybrid AI Coding Assistant SaaS utilizing both Claude API and Groq models with hybrid routing to balance cost and latency.",
        "For proof of work, check out Lilla Sushi (a live restaurant app in France) or LaraCodeVault. Feel free to explore the Portfolio and GitHub pages here!",
        "Feel free to drop him an email directly using the form on the Contact page, or connect with him on LinkedIn!"
    ];

    // Append Message helper
    const appendMessage = (sender, text) => {
        const msgDiv = document.createElement('div');
        msgDiv.className = `chat-message chat-message-${sender}`;
        msgDiv.innerText = text;
        chatBody.appendChild(msgDiv);
        
        // Auto scroll to bottom
        chatBody.scrollTop = chatBody.scrollHeight;
    };

    // Handle message sending
    const handleSendMessage = () => {
        const text = chatInput.value.trim();
        if (!text) return;

        // User message
        appendMessage('user', text);
        chatInput.value = '';

        // Bot reply loading effect
        setTimeout(() => {
            // Pick a random mock response based on text keywords if possible, otherwise random
            let reply = mockResponses[Math.floor(Math.random() * mockResponses.length)];
            
            const lowerText = text.toLowerCase();
            if (lowerText.includes('japan') || lowerText.includes('relocat')) {
                reply = "Tusher is extremely eager to relocate to Japan and is ready for an Engineer Visa sponsorship! He also has a deep interest in Japanese work culture.";
            } else if (lowerText.includes('stack') || lowerText.includes('skill') || lowerText.includes('laravel')) {
                reply = "His primary technology stack is Laravel, Inertia.js, Vue 3, and MySQL. He is also experienced in CakePHP, basic ASP.NET Core, and Power BI.";
            } else if (lowerText.includes('experience') || lowerText.includes('year') || lowerText.includes('how long')) {
                reply = "Tusher is a self-taught full-stack developer with nearly 10 years of professional experience, working both remotely and with local teams in Dhaka.";
            } else if (lowerText.includes('ai') || lowerText.includes('claude') || lowerText.includes('groq')) {
                reply = "Tusher is building AI-powered SaaS tools, specifically using Claude API and Groq for hybrid routing (speed + intelligence). Check out the Portfolio page!";
            } else if (lowerText.includes('contact') || lowerText.includes('email') || lowerText.includes('hire')) {
                reply = "You can contact Tusher directly through the form on the 'Contact Me' page, or email him at mahfoozur.rahman@example.com (placeholder)!";
            }

            appendMessage('bot', reply);
        }, 1000);
    };

    if (chatSendBtn && chatInput) {
        chatSendBtn.addEventListener('click', handleSendMessage);
        chatInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                handleSendMessage();
            }
        });
    }
});

// Dismiss Preloader when page is fully loaded
window.addEventListener('load', () => {
    const preloader = document.getElementById('preloader');
    if (preloader) {
        preloader.classList.add('fade-out');
        document.body.classList.remove('loading');
        setTimeout(() => {
            preloader.style.display = 'none';
        }, 400); // match CSS fade-out transition duration
    }
});
