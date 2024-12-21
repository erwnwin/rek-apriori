$(document).ready(function () {

	$('#loginForm').on('submit', function (e) {
		e.preventDefault();

		// Show the spinner and disable the button
		$('#btnLoader').show();
		$('#btnLogin').prop('disabled', true);

		var username = $('#username').val();
		var password = $('#password').val();

		$.ajax({
			url: 'apps/controllers/actauth.php', // Ensure this URL matches your controller's route
			type: 'POST',
			data: {
				action: 'login',
				username: $('#username').val(),
				password: $('#password').val()
			},
			dataType: 'json',
			success: function (response) {
				// Hide the spinner and enable the button
				$('#btnLoader').hide();
				$('#btnLogin').prop('disabled', false);

				if (response.status == 'success') {
					// Show success toast
					var Toast = Swal.mixin({
						toast: true,
						position: 'top-end',
						showConfirmButton: false,
						timer: 4000
					});

					Toast.fire({
						icon: 'success',
						title: response.message
					});

					// Clear form fields
					$('#username').val('');
					$('#password').val('');

					// Redirect to the specified URL after 2 seconds
					setTimeout(function () {
						window.location.href = response.redirect;
					}, 2000);
				} else {
					// Show error toast
					var Toast = Swal.mixin({
						toast: true,
						position: 'top-end',
						showConfirmButton: false,
						timer: 3000
					});

					Toast.fire({
						icon: 'error',
						title: response.message
					});
				}
			},
			error: function (xhr, status, error) {
				// Hide the spinner and enable the button
				$('#btnLoader').hide();
				$('#btnLogin').prop('disabled', false);

				console.error(xhr.responseText);
				var Toast = Swal.mixin({
					toast: true,
					position: 'top-end',
					showConfirmButton: false,
					timer: 3000
				});

				Toast.fire({
					icon: 'error',
					title: 'Something went wrong. Please try again.'
				});
			}
		});
	});
});