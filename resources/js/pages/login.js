const togglePassword = document.getElementById('toggle-password');

if (togglePassword) {
    const input = document.getElementById('password');
    const iconEye = document.getElementById('icon-eye');
    const iconEyeSlash = document.getElementById('icon-eye-slash');

    togglePassword.addEventListener('click', () => {
        const isHidden = input.type === 'password';

        input.type = isHidden ? 'text' : 'password';

        iconEye.classList.toggle('hidden', isHidden);
        iconEye.classList.toggle('block', !isHidden);
        iconEyeSlash.classList.toggle('hidden', !isHidden);
        iconEyeSlash.classList.toggle('block', isHidden);

        togglePassword.setAttribute(
            'aria-label',
            isHidden
                ? window.loginTranslations.hide_password
                : window.loginTranslations.show_password
        );
    });
}
