document.addEventListener('DOMContentLoaded', () => {
    const checkbox = document.getElementById('checkbox');
    const inputField = document.getElementById('input');

    const toggleInput = () => {
        if (checkbox && inputField) {
            inputField.classList.toggle('hidden', !checkbox.checked);
        }
    };

    if (checkbox) {
        toggleInput();
        checkbox.addEventListener('change', toggleInput);
    }

    const firstForm = document.querySelector('.firstForm');
    const secondForm = document.querySelector('.secondForm');

    if (firstForm && secondForm) {
        secondForm.style.display = 'none';

        const processButton = firstForm.querySelector('input[type="button"][value="Обработать"]');
        if (processButton) {
            processButton.addEventListener('click', () => {
                firstForm.style.display = 'none';
                secondForm.style.display = 'block';
            });
        }

        const backButton = secondForm.querySelector('input[type="button"][value="Вернуться к рефактору"]');
        if (backButton) {
            backButton.addEventListener('click', () => {
                firstForm.style.display = 'block';
                secondForm.style.display = 'none';
            });
        }
    }

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
});
