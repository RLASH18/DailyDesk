document.addEventListener("DOMContentLoaded", function () {
    // Show Password Toggle
    const togglePasswordCheckbox = document.getElementById('togglePassword');
    const passwordFields = [
        document.getElementById('password'),
        document.getElementById('current_password'),
        document.getElementById('new_password'),
        document.getElementById('confirm_password')
    ];

    if (togglePasswordCheckbox) {
        togglePasswordCheckbox.addEventListener('change', function () {
            passwordFields.forEach(field => {
                if (field) {
                    field.type = this.checked ? 'text' : 'password';
                }
            });
        });
    }
})