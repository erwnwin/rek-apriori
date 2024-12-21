// $(document).ready(function () {
// 	// Menghandle submit form update
// 	$('#formUpdateKelas').on('submit', function (e) {
// 		e.preventDefault(); // Mencegah pengiriman formulir standar

// 		var form = $(this);
// 		var formData = new FormData(form[0]);

// 		// Menampilkan overlay
// 		$('#overlayKelas').removeClass('hidden');

// 		$.ajax({
// 			url: 'kelas/act-update', // Ganti dengan URL endpoint Anda
// 			type: 'POST',
// 			data: formData,
// 			contentType: false,
// 			processData: false,
// 			success: function (response) {
// 				// Menyembunyikan overlay
// 				$('#overlayKelas').addClass('hidden');

// 				// Menangani respon dari server
// 				if (response.success) {
// 					// Tutup modal
// 					$('#modal-update').modal('hide');
// 					// Tampilkan pesan sukses
// 					alert('Data berhasil diperbarui!');
// 					// Lakukan refresh atau update data di halaman jika perlu
// 					// Contoh: location.reload(); atau update tabel di halaman
// 				} else {
// 					// Tampilkan pesan kesalahan
// 					alert('Terjadi kesalahan: ' + response.message);
// 				}
// 			},
// 			error: function (xhr, status, error) {
// 				// Menyembunyikan overlay
// 				$('#overlayKelas').addClass('hidden');

// 				// Tampilkan pesan kesalahan
// 				alert('Terjadi kesalahan: ' + error);
// 			}
// 		});
// 	});
// });

// // Fungsi untuk membuka modal dan mengisi data kelas/get-by-id/(:any)
// function openEditModal(id_kelas) {
// 	$.ajax({
// 		url: 'kelas/get-by-id' + id_kelas, // Ganti dengan URL endpoint Anda
// 		type: 'GET',
// 		success: function (response) {
// 			// Mengisi data ke form modal
// 			$('#kelasId').val(response.id_kelas);
// 			$('[name="kelas"]').val(response.kelas).trigger('change');
// 			$('[name="urutan_kelas"]').val(response.urutan_kelas).trigger('change');
// 			$('#modal-update').modal('show');
// 		}
// 	});
// }
