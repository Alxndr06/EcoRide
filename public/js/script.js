/* MENU BURGER DE LA NAVBAR */
document.addEventListener("DOMContentLoaded", () => {
    const burger = document.getElementById('burger');
    const navbar = document.getElementById('main_navbar');

    if (navbar && burger) {
        burger.addEventListener('click', () => {
            navbar.classList.toggle('show');
            document.body.classList.toggle('no-scroll');
        });
    }
});

/* HEAD SPACER */
    window.addEventListener('DOMContentLoaded', () => {
    const header = document.querySelector('header');
    const spacer = document.querySelector('.header-spacer');
    if (header && spacer) {
    spacer.style.setProperty('--header-height', header.offsetHeight + 'px');
}
});