document.querySelectorAll('.toggle-password').forEach((toggleBtn) => {
    const targetId = toggleBtn.dataset.target;
    const input = document.getElementById(targetId);
    const iconEye = toggleBtn.querySelector('.icon-eye');
    const iconEyeSlash = toggleBtn.querySelector('.icon-eye-slash');

    toggleBtn.addEventListener('click', () => {
        const isHidden = input.type === 'password';

        input.type = isHidden ? 'text' : 'password';

        iconEye.classList.toggle('hidden', isHidden);
        iconEye.classList.toggle('block', !isHidden);
        iconEyeSlash.classList.toggle('hidden', !isHidden);
        iconEyeSlash.classList.toggle('block', isHidden);

        toggleBtn.setAttribute(
            'aria-label',
            isHidden
                ? window.registerTranslations.hide_password
                : window.registerTranslations.show_password
        );
    });
});
