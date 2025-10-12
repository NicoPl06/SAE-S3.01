window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    const backToTopButton = document.querySelector('.back-to-top');
    const footer = document.querySelector('footer'); // on récupère le footer

    // --- Gestion de la navbar ---
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }

    // --- Gestion du bouton retour en haut ---
    const scrollPercentage = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;

    if (scrollPercentage > 80) {
        backToTopButton.classList.add('show');
    } else {
        backToTopButton.classList.remove('show');
    }

    // --- Éviter qu'il chevauche le footer ---
    if (footer) {
        const footerTop = footer.getBoundingClientRect().top;
        const windowHeight = window.innerHeight;

        if (footerTop < windowHeight) {
            // Si le footer est visible, on remonte le bouton
            const overlap = windowHeight - footerTop;
            backToTopButton.style.bottom = `${overlap + 20}px`; // marge de 20px au-dessus du footer
        } else {
            // Sinon, position normale
            backToTopButton.style.bottom = '20px';
        }
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    }
});

