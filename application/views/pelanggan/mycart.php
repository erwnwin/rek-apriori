<br>
<div class="container py-2 mt-4">
    <div class="d-flex justify-content-between align-items-center mt-2 p-3 bg-light shadow-sm rounded">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="<?= base_url('myhome') ?>" class="text-decoration-none text-primary">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
        </nav>
        <a href="<?= base_url('history') ?>" class="text-decoration-none text-dark">History</a>
    </div>

    <div class="row">
        <div class="col table-responsive mt-4">
            <table class="table table-hover shadow-sm rounded table-sm">
                <thead style="background-color: darkgrey;">
                    <tr>
                        <th style="width: 5px;" class="text-center">Action</th>
                        <th style="width: 25%;" class="text-center">Gambar</th>
                        <th style="width: 40%;" class="text-start">Produk</th>
                        <th class="text-start">Harga</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Sub Total</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php if (!empty($cart)) { ?>
                        <?php $no = 1;
                        foreach ($cart as $c) { ?>
                            <tr class="cart-item" data-product-id="<?= $c->product_id; ?>" data-user-id="<?= $this->session->userdata('user_id'); ?>">
                                <td class="text-center">
                                    <button class="btn btn-danger btn-sm" onclick="confirmDelete(<?= $c->id ?>)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                                <td class="text-center">
                                    <img src=" <?= base_url('public/image/product/' . $c->image) ?>" alt="" width="25%">
                                </td>
                                <td><?= $c->name ?></td>
                                <td>Rp <?= number_format($c->price, 0, ',', '.'); ?></td>
                                <td>
                                    <div class="d-flex align-items-center mb-3">
                                        <button type="button" class="btn btn-dark btn-sm btn-decrement"
                                            data-qty-id="qty_<?= $c->product_id; ?>"
                                            data-price="<?= $c->price; ?>"
                                            data-subtotal-id="cart_price_<?= $c->product_id; ?>"
                                            data-user-id="<?= $this->session->userdata('user_id'); ?>"
                                            data-product-id="<?= $c->product_id; ?>">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <span class="mx-2" id="qty_<?= $c->product_id; ?>"><?= $c->qty; ?></span>
                                        <button type="button" class="btn btn-dark btn-sm btn-increment"
                                            data-qty-id="qty_<?= $c->product_id; ?>"
                                            data-price="<?= $c->price; ?>"
                                            data-subtotal-id="cart_price_<?= $c->product_id; ?>"
                                            data-user-id="<?= $this->session->userdata('user_id'); ?>"
                                            data-product-id="<?= $c->product_id; ?>">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </td>
                                <td id="cart_price_<?= $c->product_id; ?>">
                                    Rp <?= number_format($c->price * $c->qty, 0, ',', '.'); ?>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="6">
                                <center>
                                    <img src="<?= base_url('public/no_data.svg') ?>" alt="" width="20%" class="mt-3">
                                    <p class="mt-2">Opps!! No Data Here</p>
                                </center>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row justify-content-end">
        <div class="col-lg-6">
            <div class="table-responsive">
                <table class="table text-center table-sm shadow-sm rounded" id="table-checkout">
                    <thead class="table-primary">
                        <tr>
                            <th scope="col" colspan="2">Total Cart</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="fw-bold">Total</td>
                            <td class="text-success fw-bold">Rp <span id="totalCart">Dan disini total dari cart di atas otomatis juga dihitung</span></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <form action="<?= base_url('cart/checkout') ?>" method="post" id="checkoutForm">
                                    <button type="button" class="btn btn-secondary mt-4 btn-block text-white pull-right" id="checkoutButton">Proses Checkout</button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>