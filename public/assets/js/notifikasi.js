var baseUrl = "<?= base_url('notifikasi') ?>";

function checkForNotifications() {
	fetch(baseUrl)
		.then(response => response.json())
		.then(data => {
			console.log('Notifikasi:', data);
			// Proses data notifikasi
			displayNotification(data);
		})
		.catch(error => console.error('Error:', error));
}

function displayNotification(data) {
	// Implementasikan logika untuk menampilkan notifikasi kepada pengguna
	alert('Notifikasi diterima: ' + JSON.stringify(data));
}

// Polling setiap 60 detik
setInterval(checkForNotifications, 60000);
