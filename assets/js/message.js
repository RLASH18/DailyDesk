document.addEventListener("DOMContentLoaded", function () {
    // Auto-dismiss alerts after 2 seconds
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 2000);

});


