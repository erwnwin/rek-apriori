<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once FCPATH . 'vendor/midtrans/midtrans-php/Midtrans/Config.php';
require_once FCPATH . 'vendor/midtrans/midtrans-php/Midtrans/Snap.php';
require_once FCPATH . 'vendor/midtrans/midtrans-php/Midtrans/Sanitizer.php';
require_once FCPATH . 'vendor/midtrans/midtrans-php/Midtrans/ApiRequestor.php';
require_once FCPATH . 'vendor/midtrans/midtrans-php/Midtrans/CoreApi.php';
require_once FCPATH . 'vendor/midtrans/midtrans-php/Midtrans/Notification.php';
require_once FCPATH . 'vendor/midtrans/midtrans-php/Midtrans/SnapApiRequestor.php';
require_once FCPATH . 'vendor/midtrans/midtrans-php/Midtrans/Transaction.php';


use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct(); // Load Xendit library
        $this->load->model('CheckoutModel'); // Load model transaksi
        $this->load->model('CartModel'); // Load model cart
        $this->load->config('midtrans');
    }

    public function process_checkout()
    {
        $user_id = $this->session->userdata('user_id');
        // Ambil data cart
        $cart = $this->CartModel->get_cart_by_user($user_id);

        if (!$cart) {
            show_error('Cart kosong, tidak bisa melanjutkan pembayaran');
        }

        // Generate id_transaction
        $transaction_id = "TX-" . time();

        // Hitung total harga dari cart
        $total_harga = array_sum(array_map(function ($item) {
            return $item->price * $item->qty; // Menggunakan harga dari tabel product
        }, $cart));

        // Simpan ke database transaksi baru (tanpa integrasi payment gateway)
        $this->db->insert('transactions_new', [
            'user_id' => $user_id,
            'id_transaction' => $transaction_id,
            'total_pembelian' => $total_harga, // Tambahkan total_pembelian
            'type_bayar' => 'Non-Payment Gateway',  // Menandakan transaksi tanpa payment gateway
            'tgl_transaksi' => date('Y-m-d H:i:s'),
            'status' => 'completed' // Status selesai karena tanpa payment gateway
        ]);

        // Update id_transaction untuk setiap product di cart yang statusnya 1 (belum checkout)
        foreach ($cart as $item) {
            if ($item->status == 1 && empty($item->transaction_id)) {  // Hanya update jika status 1 dan transaction_id kosong
                // Update produk di cart dengan transaction_id dan ubah status menjadi 2 (sudah checkout)
                $this->db->where('product_id', $item->product_id);
                $this->db->update(
                    'cart',
                    [
                        'transaction_id' => $transaction_id,
                        'status' => 2  // Ubah status menjadi 2 (sudah checkout)
                    ]
                );

                // Cek apakah update berhasil
                if ($this->db->affected_rows() > 0) {
                    echo "Update berhasil untuk product_id " . $item->product_id . "<br>";
                } else {
                    echo "Tidak ada perubahan untuk product_id " . $item->product_id . "<br>";
                }
            }
        }

        // Kirimkan response sukses
        echo json_encode(['status' => 'success', 'message' => 'Checkout berhasil, transaksi selesai.']);
    }







    public function success() {}
}

/* End of file CheckoutController.php */
