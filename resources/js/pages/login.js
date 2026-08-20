const togglePassword = document.getElementById('toggle-password');

if (togglePassword) {
    togglePassword.addEventListener('click', () => {
        const input = document.getElementById('password');
        const isHidden = input.type === 'password';

        input.type = isHidden ? 'text' : 'password';

        togglePassword.setAttribute(
            'aria-label',
            isHidden
                ? window.loginTranslations.hide_password
                : window.loginTranslations.show_password
        );
    });
}
