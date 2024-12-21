document.getElementById("loginForm").addEventListener("submit", function (e) {
	e.preventDefault(); // Hentikan form submit default

	const username = document.getElementById("username").value;
	const password = document.getElementById("password").value;

	$.ajax({
		url: "login/act", // URL ke controller login
		method: "POST",
		data: {
			username: username,
			password: password
		},
		success: function (response) {
			const data = JSON.parse(response);
			if (data.success) {
				// Redirect jika login berhasil
				Swal.fire({
					icon: "success",
					title: "Berhasil Login!",
					text: "Anda akan diarahkan ke dashboard.",
				}).then(() => {
					window.location.href = data.redirect;
				});
			} else {
				// Tampilkan pesan error
				Swal.fire({
					icon: "error",
					title: "Login Gagal",
					text: data.message,
				});
			}
		},
		error: function (xhr, status, error) {
			// Tampilkan error jika request gagal
			Swal.fire({
				icon: "error",
				title: "Error",
				text: "Terjadi kesalahan. Silakan coba lagi.",
			});
		}
	});
});
