document.addEventListener('DOMContentLoaded', function () {
    var STORAGE_KEY = 'openModalId';

    // Restore modal state after page refresh
    var savedModalId = sessionStorage.getItem(STORAGE_KEY);
    if (savedModalId) {
        var modalEl = document.getElementById(savedModalId);
        if (modalEl) {
            var modal = new bootstrap.Modal(modalEl);
            modal.show();
        }
    }

    // Save modal ID when any modal opens
    document.addEventListener('show.bs.modal', function (e) {
        sessionStorage.setItem(STORAGE_KEY, e.target.id);
    });

    // Remove saved state when modal is fully closed
    document.addEventListener('hidden.bs.modal', function () {
        sessionStorage.removeItem(STORAGE_KEY);
    });
});
