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

