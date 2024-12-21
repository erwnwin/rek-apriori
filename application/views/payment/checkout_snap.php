<br>
<div class="container py-2 mt-4">
  <div class="d-flex justify-content-between align-items-center mt-2 p-3 bg-light shadow-sm rounded">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="<?= base_url('cart') ?>" class="text-decoration-none text-primary">Cart</a></li>
        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
      </ol>
    </nav>
    <a href="<?= base_url('history') ?>" class="text-decoration-none text-dark">Lihat Status Pembayaran</a>
  </div>

  <div class="row">
    <?php if ($this->session->flashdata('error')): ?>
      <script>
        Swal.fire({
          icon: 'error',
          title: 'Cart Kosong',
          text: '<?php echo $this->session->flashdata('error'); ?>',
          confirmButtonText: 'OK'
        });
      </script>
    <?php endif; ?>
    <div class="col table-responsive mt-4">
      <table class="table table-bordered table-hover">
        <thead class="bg-secondary text-white">
          <tr>
            <th style="width: 40%;" class="text-start">Produk</th>
            <th class="text-start">Harga</th>
            <th class="text-center">Jumlah</th>
            <th class="text-center">Sub Total</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($cart)) { ?>
            <?php foreach ($cart as $item) { ?>
              <tr>
                <td><?= $item->name ?></td>
                <td>Rp <?= number_format($item->price, 0, ',', '.'); ?></td>
                <td class="text-center" id="cartCount" style="font-size: 17px;"><?= $item->qty; ?></td>
                <td>Rp <?= number_format($item->price * $item->qty, 0, ',', '.'); ?></td>
              </tr>
            <?php } ?>
          <?php } else { ?>
            <tr>
              <td colspan="5" class="text-center">
                <p class="text-muted">Keranjang Anda kosong. Silakan tambahkan produk.</p>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <div class="row mt-4">
    <div class="col-md-6 offset-md-6">
      <table class="table">
        <tr>
          <th>Total</th>
          <td class="text-end text-danger fw-bold">
            Rp <?= number_format($total_harga, 0, ',', '.'); ?>
          </td>
        </tr>
      </table>
      <hr>
      <button id="pay-button" class="btn btn-warning btn-block mt-3 mb-5">Proses Pembayaran</button>


      <!-- <a href="<?= base_url('checkout/process') ?>" class="btn btn-primary btn-block mt-3">Konfirmasi Pembayaran</a> -->
    </div>
  </div>

  <form id="payment-form" method="post" action="<?= base_url() ?>checkout/status">
    <input type="hidden" name="result_type" id="result-type" value="">
    <input type="hidden" name="result_data" id="result-data" value="">
  </form>


</div>