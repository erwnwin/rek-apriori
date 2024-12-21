<script src="<?= base_url() ?>public/assets/plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>public/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?= base_url() ?>public/assets/plugins/toastr/toastr.min.js"></script>
<script src="ajax/register.js"></script>
<!-- {{-- <script src="frontend/assets/js/alert.js"></script> --}} -->
<script src="<?= base_url() ?>public/json/lottie-player.js"></script>

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


</html>