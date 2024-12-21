$(document).ready(function () {
	// Fungsi untuk mengambil data mata pelajaran dan kelas
	function loadFilterOptions() {
		$.ajax({
			url: 'mata-pelajaran/get-filter',
			type: 'GET',
			success: function (response) {
				var result = JSON.parse(response);

				// Mengisi dropdown mata pelajaran dengan data unik
				var mapelOptions = '<option value="">Pilih Mata Pelajaran</option>';
				var mapelSet = new Set();
				$.each(result.mapel, function (index, item) {
					if (!mapelSet.has(item.nama_mapel)) {
						mapelOptions += `<option value="${item.kode_mapel}">${item.nama_mapel}</option>`;
						mapelSet.add(item.nama_mapel);
					}
				});
				$('#filter-mapel').html(mapelOptions);

				// Mengisi dropdown kelas dengan data unik
				var kelasOptions = '<option value="">Pilih Kelas</option>';
				var kelasSet = new Set();
				$.each(result.kelas, function (index, item) {
					if (!kelasSet.has(item.id_kelas)) {
						kelasOptions += `<option value="${item.id_kelas}">${item.kelas} ${item.urutan_kelas}</option>`;
						kelasSet.add(item.id_kelas);
					}
				});
				$('#filter-kelas').html(kelasOptions);
			}
		});
	}

	// Fungsi untuk memfilter data
	function filterData() {
		var selectedMapel = $('#filter-mapel').val();
		var selectedKelas = $('#filter-kelas').val();

		$('#overlayGuru').removeClass('hidden');

		$.ajax({
			url: 'mata-pelajaran/get-filter2',
			type: 'POST',
			data: {
				kode_mapel: selectedMapel,
				id_kelas: selectedKelas
			},
			success: function (response) {
				$('#overlayGuru').addClass('hidden');
				var result = JSON.parse(response);
				var tbody = '';

				if (result.mapel.length > 0) {
					$.each(result.mapel, function (index, item) {
						tbody += `<tr>
                            <td>${index + 1}</td>
                            <td class="text-center">${item.kode_mapel}</td>
                            <td>${item.nama_mapel}</td>
                            <td class="text-center">${item.id_kelas}</td>
                            <td class="text-center">${item.beban_jam} Jam</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#modal-edit${item.id_mapel}">Edit</button>
                            </td>
                        </tr>`;
					});
				} else {
					tbody = '<tr><td colspan="6"><center>Tidak ada data</center></td></tr>';
				}

				$('#mapel-tbody').html(tbody);
			},
			error: function () {
				$('#overlayGuru').addClass('hidden');
				alert('Terjadi kesalahan saat memuat data.');
			}
		});
	}

	// Load filter options saat dokumen siap
	loadFilterOptions();

	// Filter data saat dropdown berubah
	$('#filter-mapel, #filter-kelas').on('change', function () {
		filterData();
	});

	// Load data saat halaman dimuat
	// filterData();
});
