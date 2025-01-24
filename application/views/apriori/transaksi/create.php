<!-- File: application/views/transaksi/add.php -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create History Transaksi</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Transaksi Batch <span class="text-danger">*(Opsional Fitur)</span></h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('transaksi/save_batch'); ?>" method="post">
                        <div class="form-group">
                            <label for="tanggal">Tanggal Transaksi</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="user_id">Nama Customer</label>
                            <select name="user_id" class="form-control" required>
                                <option value="">Pilih Customer</option>
                                <?php foreach ($customers as $customer) : ?>
                                    <option value="<?= $customer->id; ?>">
                                        <?= $customer->first_name . ' ' . $customer->last_name; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <table class="table table-bordered" id="dynamic_field">
                            <tr>
                                <th>Nama Barang</th>
                                <th style="width: 100px;">Jumlah</th>
                                <th style="width: 150px;">Harga</th>
                                <th style="width: 180px;">Total</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="product_id[]" class="form-control product-select" required>
                                        <option value="">Pilih Barang</option>
                                        <?php foreach ($products as $product) : ?>
                                            <option value="<?= $product->id; ?>" data-harga="<?= $product->price; ?>">
                                                <?= $product->name; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td><input type="number" name="jumlah[]" class="form-control jumlah" required></td>
                                <td><input type="text" name="harga[]" class="form-control harga" readonly></td>
                                <td><input type="text" name="total[]" class="form-control total" readonly></td>
                                <td><button type="button" name="add" id="add" class="btn btn-successku">Add More</button></td>
                            </tr>
                        </table>
                        <button type="submit" class="btn btn-primaryku">Simpan Batch</button>
                    </form>
                </div>
            </div>


        </div>
    </section>
    <div>
        <br>
    </div>
</div>