const copyIcons = document.querySelectorAll('.copy');
const copyToast = document.getElementById('copyToast');
let toastTimeout;

copyIcons.forEach((icon) => {
    icon.addEventListener('click', () => {
        const inputEl = icon.closest('.copy-wrapper')?.querySelector('.short-result-input');

        if (inputEl && inputEl.value) {
            navigator.clipboard.writeText(inputEl.value);

            if (copyToast) {
                copyToast.classList.add('show');
                clearTimeout(toastTimeout);
                toastTimeout = setTimeout(() => {
                    copyToast.classList.remove('show');
                }, 2500);
            }
        }
    });
});
