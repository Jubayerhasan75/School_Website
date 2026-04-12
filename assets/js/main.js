document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');

    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            
            if (mobileMenu.classList.contains('hidden')) {
                menuIcon.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
            } else {
                menuIcon.setAttribute('d', 'M6 18L18 6M6 6l12 12');
            }
        });
    }

    let currentSlide = 0;
    const slides = document.querySelectorAll('#slider > div');
    const sliderContainer = document.getElementById('slider');

    window.nextSlide = function() {
        if (slides.length > 0) {
            currentSlide = (currentSlide + 1) % slides.length;
            updateSlider();
        }
    }

    window.prevSlide = function() {
        if (slides.length > 0) {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            updateSlider();
        }
    }

    function updateSlider() {
        if (sliderContainer) {
            sliderContainer.style.transform = `translateX(-${currentSlide * 100}%)`;
        }
    }

    if (slides.length > 0) {
        setInterval(nextSlide, 5000);
    }
});