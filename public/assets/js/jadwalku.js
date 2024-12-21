$(document).ready(function () {

	$("select[name='btnPilihJadwal']").select2();

	/*
	 * Proses submit form pemilihan kurikulum
	 */
	$("select[name='btnPilihJadwal']").change(function () {
		$("#formJadwalku").submit();
	});

	/*
	 * Menampilkan box loading state pada saat proses submit form berlangsung
	 */
	$("#formJadwalku").submit(function () {
		$("#divOverlayformJadwalku").removeClass("hidden");
	});

});
