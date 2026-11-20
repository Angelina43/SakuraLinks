document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('deleteModal');
    const confirmBtn = document.getElementById('confirmDeleteBtn');
    const cancelBtn = document.getElementById('cancelDeleteBtn');
    let activeForm = null;

    document.querySelectorAll('.js-open-delete-modal').forEach(btn => {
        btn.addEventListener('click', () => {
            activeForm = btn.closest('form');
            modal.classList.add('active');
        });
    });

    cancelBtn.addEventListener('click', () => {
        modal.classList.remove('active');
        activeForm = null;
    });

    confirmBtn.addEventListener('click', () => {
        if (activeForm) activeForm.submit();
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.remove('active');
            activeForm = null;
        }
    });
});
