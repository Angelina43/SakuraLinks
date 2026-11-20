document.addEventListener('DOMContentLoaded', () => {
    const deleteModal = document.getElementById('deleteModal');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
    let activeDeleteForm = null;

    document.querySelectorAll('.js-open-delete-modal').forEach(btn => {
        btn.addEventListener('click', () => {
            activeDeleteForm = btn.closest('form');
            deleteModal.classList.add('active');
        });
    });

    cancelDeleteBtn.addEventListener('click', () => {
        deleteModal.classList.remove('active');
        activeDeleteForm = null;
    });

    confirmDeleteBtn.addEventListener('click', () => {
        if (activeDeleteForm) activeDeleteForm.submit();
    });

    const editModal = document.getElementById('editModal');
    const editForm = document.getElementById('editUrlForm');
    const editNameInput = document.getElementById('editNameUrl');
    const editShortInput = document.getElementById('editShortUrl');
    const editDescInput = document.getElementById('editDescriptionUrl');
    const cancelEditBtn = document.getElementById('cancelEditBtn');

    document.querySelectorAll('.js-open-edit-modal').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.modal-error').forEach(el => el.remove());
            document.querySelectorAll('.modal-input.is-invalid').forEach(el => el.classList.remove('is-invalid'));

            editForm.action = btn.dataset.action;
            editNameInput.value = btn.dataset.name;
            editShortInput.value = btn.dataset.short;
            editDescInput.value = btn.dataset.description || '';
            editModal.classList.add('active');
        });
    });

    cancelEditBtn.addEventListener('click', () => {
        editModal.classList.remove('active');
    });

    [deleteModal, editModal].forEach(modal => {
        modal.addEventListener('click', (e) => {
            if (e.target === modal) modal.classList.remove('active');
        });
    });
});
