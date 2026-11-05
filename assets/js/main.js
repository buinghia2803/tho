
document.addEventListener('DOMContentLoaded', function () {
    const categoryMenu = document.querySelector('.sidebar-category-menu');
    const categoryToggle = document.querySelector('.sidebar-category-toggle');

    if (categoryMenu && categoryToggle) {
        categoryToggle.addEventListener('click', function () {
            const isExpanded = categoryToggle.getAttribute('aria-expanded') === 'true';
            categoryToggle.setAttribute('aria-expanded', String(!isExpanded));
            categoryMenu.classList.toggle('is-open', !isExpanded);
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && categoryMenu.classList.contains('is-open')) {
                categoryMenu.classList.remove('is-open');
                categoryToggle.setAttribute('aria-expanded', 'false');
                categoryToggle.focus();
            }
        });
    }

    const menuToggle = document.querySelector('.menu-toggle');
    const primaryNavigation = document.querySelector('.primary-navigation');

    if (!menuToggle || !primaryNavigation) {
        return;
    }

    menuToggle.addEventListener('click', function () {
        const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
        menuToggle.setAttribute('aria-expanded', String(!isExpanded));
        primaryNavigation.classList.toggle('is-open', !isExpanded);
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && primaryNavigation.classList.contains('is-open')) {
            primaryNavigation.classList.remove('is-open');
            menuToggle.setAttribute('aria-expanded', 'false');
            menuToggle.focus();
        }
    });
});
