function closeDropdown(dropdown) {
    const trigger = dropdown.querySelector('[data-dropdown-trigger]');
    const menu = dropdown.querySelector('[data-dropdown-menu]');
    trigger.removeAttribute('data-open');
    menu.removeAttribute('data-open');
    trigger.setAttribute('aria-expanded', 'false');
}

function openDropdown(dropdown) {
    const trigger = dropdown.querySelector('[data-dropdown-trigger]');
    const menu = dropdown.querySelector('[data-dropdown-menu]');
    trigger.setAttribute('data-open', '');
    menu.setAttribute('data-open', '');
    trigger.setAttribute('aria-expanded', 'true');
}

const dropdowns = document.querySelectorAll('[data-dropdown]');

dropdowns.forEach((dropdown) => {
    const trigger = dropdown.querySelector('[data-dropdown-trigger]');

    if (dropdown.hasAttribute('data-dropdown-hover')) {
        let closeTimeout;

        dropdown.addEventListener('mouseenter', () => {
            clearTimeout(closeTimeout);
            dropdowns.forEach((other) => {
                if (other !== dropdown) closeDropdown(other);
            });
            openDropdown(dropdown);
        });

        dropdown.addEventListener('mouseleave', () => {
            closeTimeout = setTimeout(() => closeDropdown(dropdown), 300);
        });

        return;
    }

    trigger.addEventListener('click', (event) => {
        event.stopPropagation();
        const isOpen = trigger.hasAttribute('data-open');

        dropdowns.forEach((other) => closeDropdown(other));

        if (!isOpen) {
            openDropdown(dropdown);
        }
    });
});

document.addEventListener('click', (event) => {
    dropdowns.forEach((dropdown) => {
        if (!dropdown.contains(event.target)) {
            closeDropdown(dropdown);
        }
    });
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        dropdowns.forEach((dropdown) => closeDropdown(dropdown));
    }
});

const mobileMenuTrigger = document.querySelector('[data-mobile-menu-trigger]');
const mobileMenu = document.querySelector('[data-mobile-menu]');

if (mobileMenuTrigger && mobileMenu) {
    const iconOpen = mobileMenuTrigger.querySelector('[data-mobile-menu-icon-open]');
    const iconClose = mobileMenuTrigger.querySelector('[data-mobile-menu-icon-close]');

    const closeMobileMenu = () => {
        mobileMenu.classList.add('hidden');
        mobileMenuTrigger.setAttribute('aria-expanded', 'false');
        iconOpen.classList.remove('hidden');
        iconClose.classList.add('hidden');
    };

    const openMobileMenu = () => {
        mobileMenu.classList.remove('hidden');
        mobileMenuTrigger.setAttribute('aria-expanded', 'true');
        iconOpen.classList.add('hidden');
        iconClose.classList.remove('hidden');
    };

    mobileMenuTrigger.addEventListener('click', (event) => {
        event.stopPropagation();
        const isOpen = mobileMenuTrigger.getAttribute('aria-expanded') === 'true';
        isOpen ? closeMobileMenu() : openMobileMenu();
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeMobileMenu();
        }
    });

    window.matchMedia('(min-width: 851px)').addEventListener('change', (event) => {
        if (event.matches) {
            closeMobileMenu();
        }
    });
}
