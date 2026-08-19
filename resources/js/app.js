import Alpine from 'alpinejs';
window.Alpine = Alpine; Alpine.start();

import $ from 'jquery';

window.$ = $;
window.jQuery = $;
document.addEventListener('DOMContentLoaded', () => {
    /* =========================
       Menu utilisateur
    ========================= */

    const userBurgerBtn = document.getElementById('user-burger-btn');
    const userMenu = document.getElementById('user-mobile-menu');
    const burgerMenuClose = document.getElementById('burger-menu-close');
    const burgerMenuOpen = document.getElementById('burger-menu-open');


    /* =========================
       Menu burger
    ========================= */

    const burgerBtn = document.getElementById('burger-btn');
    const menu = document.getElementById('mobile-menu');
    const menuClose = document.getElementById('menu-close');
    const menuOpen = document.getElementById('menu-open');


    /* =========================
       Menu utilisateur
    ========================= */

    const openUserMenu = () => {
        if (!userMenu) {
            return;
        }

        userMenu.classList.remove(
            'hidden',
            'max-h-0',
            'opacity-0'
        );

        userMenu.classList.add(
            'flex',
            'max-h-[500px]',
            'opacity-100'
        );

        burgerMenuClose?.classList.add('hidden');
        burgerMenuOpen?.classList.remove('hidden');
    };


    const closeUserMenu = () => {
        if (!userMenu) {
            return;
        }

        userMenu.classList.add(
            'hidden',
            'max-h-0',
            'opacity-0'
        );

        userMenu.classList.remove(
            'flex',
            'max-h-[500px]',
            'opacity-100'
        );

        burgerMenuClose?.classList.remove('hidden');
        burgerMenuOpen?.classList.add('hidden');
    };


    /* =========================
       Menu burger
    ========================= */

    const openBurgerMenu = () => {
        if (!menu) {
            return;
        }

        menu.classList.remove(
            'hidden',
            'max-h-0',
            'opacity-0'
        );

        menu.classList.add(
            'flex',
            'max-h-[500px]',
            'opacity-100'
        );

        menuClose?.classList.add('hidden');
        menuOpen?.classList.remove('hidden');
    };


    const closeBurgerMenu = () => {
        if (!menu) {
            return;
        }

        menu.classList.add(
            'hidden',
            'max-h-0',
            'opacity-0'
        );

        menu.classList.remove(
            'flex',
            'max-h-[500px]',
            'opacity-100'
        );

        menuClose?.classList.remove('hidden');
        menuOpen?.classList.add('hidden');
    };


    /* =========================
       Clic menu utilisateur
       Uniquement si connecté
    ========================= */

    if (userBurgerBtn && userMenu) {
        userBurgerBtn.addEventListener('click', () => {
            const isClosed = userMenu.classList.contains('hidden');

            if (isClosed) {
                // Ferme le menu burger
                closeBurgerMenu();

                // Ouvre le menu utilisateur
                openUserMenu();
            } else {
                closeUserMenu();
            }
        });
    }


    /* =========================
       Clic menu burger
    ========================= */

    if (burgerBtn && menu) {
        burgerBtn.addEventListener('click', () => {
            const isClosed = menu.classList.contains('hidden');

            if (isClosed) {
                // Ferme le menu utilisateur s'il existe
                closeUserMenu();

                // Ouvre le menu burger
                openBurgerMenu();
            } else {
                closeBurgerMenu();
            }
        });
    }
});