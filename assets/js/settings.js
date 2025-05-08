document.addEventListener("DOMContentLoaded", function () {

    //shows the profile first 
    const fileInput = document.getElementById('profile_picture');

    if (fileInput) {
        fileInput.addEventListener('change', function (event) {
            const reader = new FileReader();
            const preview = document.getElementById('profile-pic-preview');

            reader.onload = function () {
                preview.src = reader.result;
            }

            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        });
    }
});