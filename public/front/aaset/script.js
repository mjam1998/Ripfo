// Book Cards Hover Effect with Background Color Change
document.addEventListener('DOMContentLoaded', function () {
    const bookCards = document.querySelectorAll('.book-card');

    bookCards.forEach(card => {
        const bgColor = card.getAttribute('data-bg-color');

        card.addEventListener('mouseenter', function () {
            this.style.setProperty('--hover-bg-color', bgColor);
        });

        card.addEventListener('mouseleave', function () {
            this.style.setProperty('--hover-bg-color', '#f8f9fa');
        });
    });
});

// Word Cloud Animation
const words = document.querySelectorAll('.word');
words.forEach(word => {
    word.addEventListener('click', function () {
        this.style.animation = 'pulse 0.5s';
        setTimeout(() => {
            this.style.animation = '';
        }, 500);
    });
});

// Search Functionality
const searchInput = document.querySelector('.search-box input');
const searchButton = document.querySelector('.search-box button');

searchButton.addEventListener('click', function () {
    const searchTerm = searchInput.value.trim();
    if (searchTerm) {
        alert(`جستجو برای: ${searchTerm}`);
        // اینجا می‌توانید لاجیک جستجو را اضافه کنید
    }
});

searchInput.addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        searchButton.click();
    }
});

// Smooth Scroll
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Add animation on scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver(function (entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.animation = 'fadeInUp 0.6s ease-out';
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

// Observe elements
document.querySelectorAll('.article-card, .book-card').forEach(el => {
    observer.observe(el);
});

// Add CSS animation keyframes dynamically
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeInUp {
    from {
    opacity: 0;
    transform: translateY(30px);
    }
    to {
    opacity: 1;
    transform: translateY(0);
    }
    }
    
    @keyframes pulse {
    0%, 100% {
    transform: scale(1);
    }
    50% {
    transform: scale(1.3);
    }
    }
    `;
document.head.appendChild(style);
// JavaScript for Tab Switching
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons and contents
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            
            // Add active class to clicked button
            this.classList.add('active');
            
            // Show corresponding content
            const tabId = this.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });
});

