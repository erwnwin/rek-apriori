<!-- footer section -->
<footer class="footer_section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-3 footer-col">
                <div class="footer_detail">
                    <h4>
                        Tentang Kami
                    </h4>
                    <p>
                        Necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with
                    </p>

                </div>
            </div>
            <div class="col-md-6 col-lg-3 footer-col">
                <div class="footer_contact">
                    <h4>
                        Offline Store Kami
                    </h4>
                    <div class="contact_link_box">
                        <a href="">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <span>
                                Lokasi :
                            </span>
                        </a>
                        <a href="">
                            <i class="fa fa-whatsapp" aria-hidden="true"></i>
                            <span>
                                HP/WA. 0821xxxxxxxx
                            </span>
                        </a>
                        <a href="">
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                            <span>
                                IG :
                            </span>
                        </a>
                        <a href="">
                            <i class="fa fa-youtube" aria-hidden="true"></i>
                            <span>
                                Youtube :
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-6 footer-col">
                <div class="map_container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27526.67500364611!2d119.48654453933393!3d-5.139787562051907!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbefdd01a7a1e75%3A0x8831aee4b19747ae!2sperintis%20kemerdekaan%2012!5e1!3m2!1sen!2sid!4v1726069488274!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
        <div class="footer-info">
            <p>
                &copy; <span id="displayYear"></span> Copyright by ~ 2024
                <a href="#"><b>Titik Balik Teknologi - Makassar</b></a>
            </p>
        </div>
    </div>
</footer>
<!-- footer section -->

<script src="<?= base_url() ?>assets/frontend-ui/js/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="<?= base_url() ?>assets/frontend-ui/js/bootstrap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
</script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="Mid-client-REesfKrybawWgF9r"></script>


<script>
    // Tampilkan loading
    function showLoading() {
        document.getElementById('loading-overlay').style.display = 'flex';
    }

    // Sembunyikan loading
    function hideLoading() {
        document.getElementById('loading-overlay').style.display = 'none';
    }

    // Contoh Fetch API dengan loading
    async function fetchData(url) {
        showLoading(); // Tampilkan loading
        try {
            const response = await fetch(url);
            const data = await response.json();
            console.log(data);
        } catch (error) {
            console.error('Error fetching data:', error);
        } finally {
            hideLoading(); // Sembunyikan loading setelah selesai
        }
    }

    // Contoh penggunaan Fetch API
    document.addEventListener('DOMContentLoaded', function() {
        fetchData('https://jsonplaceholder.typicode.com/posts');
    });


    // Tampilkan loading saat link diklik
    document.querySelectorAll('a').forEach(function(link) {
        link.addEventListener('click', function(e) {
            // Tampilkan overlay
            showLoading();

            // Biarkan browser melakukan navigasi setelah beberapa saat
            setTimeout(function() {
                window.location.href = link.href;
            }, 500); // 500ms untuk memberikan efek loading
            e.preventDefault(); // Hentikan navigasi default sementara
        });
    });
</script>

<script>
    let currentQty = 1;
    const maxStock = <?= $product->qty ?>;

    // Fungsi untuk mengurangi qty
    document.getElementById("minCart").addEventListener("click", () => {
        if (currentQty > 1) {
            currentQty--;
            document.getElementById("qtyCart").innerText = currentQty;
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Minimun order 1 pcs',
                text: 'Jumlah pembelian tidak boleh kurang dari 1',
            });
        }
    });

    // Fungsi untuk menambah qty
    document.getElementById("plusCart").addEventListener("click", () => {
        if (currentQty < maxStock) {
            currentQty++;
            document.getElementById("qtyCart").innerText = currentQty;
        } else {
            Swal.fire({
                icon: 'warning',
                title: 'Stok Habis',
                text: 'Jumlah pembelian tidak boleh melebihi stok yang tersedia.',
            });
        }
    });

    // Fungsi untuk menambahkan produk ke keranjang
    document.getElementById("addToCart").addEventListener("click", () => {
        const productId = <?= $product->id ?>; // Ambil ID produk dari PHP
        const qty = currentQty;

        // Kirim data ke backend menggunakan URL dan $.ajax
        $.ajax({
            url: "../../cart/add", // URL tujuan untuk menambah ke cart
            method: "POST",
            data: {
                product_id: productId,
                qty: qty
            },
            success: function(data) {
                const response = JSON.parse(data);
                if (response.success) {
                    Swal.fire({
                        icon: "success",
                        title: "Berhasil!",
                        text: "Produk berhasil ditambahkan ke keranjang!",
                    });
                    updateCartCount();
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: response.message || "Terjadi kesalahan saat menambahkan produk.",
                    });
                }
            },
            error: function(error) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Terjadi kesalahan pada server.",
                });
            }
        });
    });


    function updateCartCount() {
        fetch('../../cart/getCartCount')
            .then(response => response.json())
            .then(data => {
                const cartCountElement = document.getElementById('cartCount');
                cartCountElement.textContent = data.count; // Perbarui angka di badge
            })
            .catch(error => console.error('Error updating cart count:', error));
    }

    // Panggil fungsi saat halaman dimuat untuk memastikan jumlah cart sesuai
    document.addEventListener('DOMContentLoaded', function() {
        updateCartCount();
    });
</script>

<script>
    function updateCartCount() {
        fetch('cart/getCartCount')
            .then(response => response.json())
            .then(data => {
                const cartCountElement = document.getElementById('cartCount');
                cartCountElement.textContent = data.count; // Perbarui angka di badge
            })
            .catch(error => console.error('Error updating cart count:', error));
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateCartCount();
    });
</script>

<script>
    function confirmDelete(cartId) {
        // Menampilkan SweetAlert konfirmasi
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Item ini akan dihapus dari keranjang!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika di-klik "Hapus", lakukan penghapusan via Ajax
                $.ajax({
                    url: "<?= base_url('cart/deleteItem') ?>", // Ganti URL sesuai dengan controller Anda
                    method: "POST",
                    data: {
                        id: cartId
                    }, // Kirim ID item yang akan dihapus
                    dataType: "json", // Pastikan response diproses sebagai JSON
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Item berhasil dihapus dari keranjang!',
                                showConfirmButton: false,
                            });
                            setTimeout(function() {
                                location.reload(); // Reload halaman setelah 1 detik
                            }, 1500);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: response.message || 'Terjadi kesalahan saat menghapus item.',
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan pada server.',
                        });
                    }
                });
            }
        });
    }
</script>
<script>
    window.onscroll = function() {
        scrollFunction()
    };

    function scrollFunction() {
        var navbar = document.getElementById("navbar");
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        updateAllCartItems();
        calculateTotalCart();
    });

    // Event listener untuk tombol tambah dan kurang qty
    document.addEventListener('click', function(event) {
        // Tombol kurang (decrement)
        if (event.target.closest('.btn-decrement')) {
            let button = event.target.closest('.btn-decrement');
            updateCart(button, -1); // Mengurangi qty
        }

        // Tombol tambah (increment)
        if (event.target.closest('.btn-increment')) {
            let button = event.target.closest('.btn-increment');
            updateCart(button, 1); // Menambah qty
        }
    });

    // Fungsi utama untuk memperbarui qty
    function updateCart(button, change) {
        // Ambil data dari data attributes
        let qtyId = button.dataset.qtyId;
        let price = parseInt(button.dataset.price);
        let subtotalId = button.dataset.subtotalId;
        let userId = button.dataset.userId;
        let productId = button.dataset.productId;

        // Ambil elemen qty dan subtotal
        let qtyElement = document.getElementById(qtyId);
        let subtotalElement = document.getElementById(subtotalId);

        let currentQty = parseInt(qtyElement.textContent);
        let newQty = currentQty + change;

        // Validasi qty agar tidak kurang dari 1
        if (newQty < 1) {
            Swal.fire({
                icon: 'warning',
                title: 'Minimum order 1 pcs',
                text: 'Jumlah pembelian tidak boleh kurang dari 1',
            });
            return;
        }

        // Kirim update ke server dengan AJAX
        fetch('<?= base_url('cart/updateQty'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    user_id: userId,
                    product_id: productId,
                    qty: newQty
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Update qty dan subtotal di sisi client
                    qtyElement.textContent = newQty;
                    let newSubtotal = newQty * price;
                    subtotalElement.textContent = `Rp ${newSubtotal.toLocaleString('id-ID')}`;

                    // Hitung ulang total cart
                    calculateTotalCart();

                    // Perbarui semua data cart ke server
                    updateAllCartItems();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Gagal memperbarui keranjang!',
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Terjadi kesalahan koneksi!');
            });
    }

    // Fungsi untuk menghitung ulang total cart
    function calculateTotalCart() {
        let total = 0;

        // Ambil semua subtotal
        document.querySelectorAll('[id^="cart_price_"]').forEach(subtotal => {
            total += parseInt(subtotal.textContent.replace(/\D/g, ''));
        });

        // Update total cart
        document.getElementById('totalCart').textContent = `${total.toLocaleString('id-ID')}`;
    }

    // Fungsi untuk mengirim semua item cart ke server
    function updateAllCartItems() {
        let cartItems = [];

        // Loop melalui semua elemen produk di cart
        document.querySelectorAll('[id^="qty_"]').forEach(qtyElement => {
            let productId = qtyElement.id.replace('qty_', '');
            let qty = parseInt(qtyElement.textContent);
            let userId = document.querySelector(`[data-product-id="${productId}"]`).dataset.userId;

            cartItems.push({
                user_id: userId,
                product_id: productId,
                qty: qty
            });
        });

        // Kirim data ke server menggunakan AJAX
        fetch('<?= base_url("cart/updateAllQty"); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    cart_items: cartItems
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    console.log('Semua data cart berhasil diperbarui.');
                } else {
                    console.error('Gagal memperbarui semua data cart.');
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>
<script>
    $('#checkoutButton').click(function() {
        $.ajax({
            url: '<?= base_url("checkout/process-checkout") ?>',
            type: 'POST',
            success: function(response) {
                const result = JSON.parse(response);
                if (result.snapToken) {
                    // Buka Midtrans Snap Popup
                    snap.pay(result.snapToken, {
                        onSuccess: function(result) {
                            alert('Pembayaran Berhasil!');
                            console.log(result);
                            window.location.href = "<?= base_url('checkout/success') ?>";
                        },
                        onPending: function(result) {
                            alert('Pembayaran Tertunda!');
                            console.log(result);
                        },
                        onError: function(result) {
                            alert('Pembayaran Gagal!');
                            console.log(result);
                        }
                    });
                } else {
                    alert('Gagal memproses pembayaran: ' + result.error);
                }
            }
        });
    });
</script>

<script>
    document.getElementById('checkoutButton').addEventListener('click', function() {
        // Lakukan request AJAX atau cek kondisi keranjang
        fetch('<?= base_url("cart/kosong") ?>') // Buat endpoint untuk memeriksa keranjang
            .then(response => response.json())
            .then(data => {
                if (data.empty) {
                    // Jika keranjang kosong, tampilkan SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Cart Kosong',
                        text: 'Keranjang kosong, tidak bisa melanjutkan checkout.',
                        confirmButtonText: 'OK'
                    });
                } else {
                    // Jika keranjang tidak kosong, submit form
                    document.getElementById('checkoutForm').submit();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Terjadi kesalahan saat memproses permintaan.',
                    confirmButtonText: 'OK'
                });
            });
    });
</script>



</body>

</html>