<script src="<?= base_url() ?>public/assets/plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>public/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url() ?>public/assets/plugins/toastr/toastr.min.js"></script>
<script src="ajax/register.js"></script>
<!-- {{-- <script src="frontend/assets/js/alert.js"></script> --}} -->
<script src="<?= base_url() ?>public/json/lottie-player.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function formatDate() {
        const input = document.getElementById("tgl_lahir");
        const dateValue = input.value;

        if (dateValue) {
            const [year, month, day] = dateValue.split("-");
            input.type = 'text';
            input.value = `${day}/${month}/${year}`;
        } else {
            input.type = 'text'; // Reset to text type if no date is selected
        }
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('registerForm');
        const loadingOverlay = document.getElementById('loading-overlay');
        const btnRegister = document.getElementById('btnRegister');

        // Handle form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Show loading overlay
            showLoading();

            // Get form data
            const formData = new FormData(form);

            // Validate form data before sending
            if (validateForm(formData)) {
                // Send data via AJAX
                fetch('<?php echo base_url('auth/register'); ?>', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        hideLoading();
                        if (data.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: data.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                            form.reset();
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: data.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    })
                    .catch(error => {
                        hideLoading();
                        Swal.fire({
                            title: 'Error!',
                            text: 'An error occurred. Please try again later.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
            } else {
                // Hide loading overlay if validation fails
                hideLoading();
            }
        });

        // Function to show the loading overlay
        function showLoading() {
            loadingOverlay.style.display = 'flex';
            btnRegister.disabled = true; // Disable button during loading
        }

        // Function to hide the loading overlay
        function hideLoading() {
            loadingOverlay.style.display = 'none';
            btnRegister.disabled = false; // Enable button after loading
        }

        // Function to validate form data
        function validateForm(formData) {
            const firstName = formData.get('first_name').trim();
            const lastName = formData.get('last_name').trim();
            const username = formData.get('username').trim();
            const email = formData.get('email').trim();
            const password = formData.get('password');
            const passwordConfirmation = formData.get('password_confirmation');
            const phone = formData.get('phone').trim();
            const address = formData.get('address').trim();

            if (!firstName || !lastName || !username || !email || !password || !passwordConfirmation || !phone || !address) {
                Swal.fire({
                    title: 'Error!',
                    text: 'All fields are required.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return false;
            }

            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Please enter a valid email address.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return false;
            }

            if (password.length < 6) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Password must be at least 6 characters long.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return false;
            }

            if (password !== passwordConfirmation) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Password and confirmation do not match.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return false;
            }

            if (isNaN(phone) || phone.trim() === '') {
                Swal.fire({
                    title: 'Error!',
                    text: 'Please enter a valid phone number.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return false;
            }

            return true; // All validations passed
        }
    });
</script>



</html>