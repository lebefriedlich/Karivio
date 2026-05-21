document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('mobile-menu-btn');
    const overlay = document.getElementById('mobile-overlay');
    const drawer = document.getElementById('mobile-drawer');
    const icon = document.getElementById('mobile-menu-icon');
    const menuLinks = drawer.querySelectorAll('a');

    function toggleMenu() {
        const isHidden = drawer.classList.contains('hidden');

        if (isHidden) {
            overlay.classList.remove('hidden');
            drawer.classList.remove('hidden');
            drawer.classList.add('flex');
            // Slight delay to allow display block to apply before opacity transition
            setTimeout(() => {
                overlay.classList.remove('opacity-0');
                drawer.classList.remove('translate-x-full');
                drawer.classList.add('translate-x-0');
            }, 10);
            icon.classList.remove('ri-menu-3-line');
            icon.classList.add('ri-close-line');
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        } else {
            overlay.classList.add('opacity-0');
            drawer.classList.remove('translate-x-0');
            drawer.classList.add('translate-x-full');
            setTimeout(() => {
                overlay.classList.add('hidden');
                drawer.classList.remove('flex');
                drawer.classList.add('hidden');
            }, 300); // Wait for transition
            icon.classList.remove('ri-close-line');
            icon.classList.add('ri-menu-3-line');
            document.body.style.overflow = ''; // Restore scrolling
        }
    }

    btn.addEventListener('click', toggleMenu);
    overlay.addEventListener('click', toggleMenu); // Click overlay to close

    // Close menu when clicking a link
    menuLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (!drawer.classList.contains('hidden')) {
                toggleMenu();
            }
        });
    });
});
