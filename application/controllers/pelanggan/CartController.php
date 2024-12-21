<?php

defined('BASEPATH') or exit('No direct script access allowed');

class CartController extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('CartModel');
        $this->load->model('ProduksModel');
        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
        $hak_akses = $this->session->userdata('hak_akses');
        if ($hak_akses != "Client") {
            $this->session->sess_destroy();
            redirect(base_url('beranda'));
        }
    }


    public function index()
    {
        $data['title'] = 'Books';

        // $user_id = '1';
        $user_id = $this->session->userdata('user_id');
        $data['cart'] = $this->CartModel->getCartByUserId($user_id);


        $this->load->view('pelanggan/template/head', $data);
        $this->load->view('pelanggan/mycart', $data);
        $this->load->view('pelanggan/template/footer', $data);
    }

    public function add()
    {
        $productId = $this->input->post('product_id');
        $qty = $this->input->post('qty');
        $userId = $this->session->userdata('user_id');

        // Validasi input
        if (empty($productId) || $qty <= 0) {
            echo json_encode(['success' => false, 'message' => 'Data produk atau jumlah tidak valid.']);
            return;
        }

        // Ambil detail produk dari database untuk memastikan stok cukup
        $product = $this->ProduksModel->get_product_by_id_id($productId);

        if (!$product) {
            echo json_encode(['success' => false, 'message' => 'Produk tidak ditemukan.']);
            return;
        }

        // Pastikan jumlah produk yang diminta tidak melebihi stok
        if ($qty > $product->qty) {
            echo json_encode(['success' => false, 'message' => 'Stok tidak cukup.']);
            return;
        }

        // Periksa apakah produk dengan status 1 sudah ada di keranjang
        $cartItem = $this->CartModel->getCartItemByStatus($userId, $productId, 1);

        if ($cartItem) {
            // Jika produk dengan status 1 ada, update jumlah
            $this->CartModel->updateCartItem($cartItem->id, $cartItem->qty + $qty);
        } else {
            // Jika produk belum ada atau hanya ada dengan status 2, tambahkan produk baru
            $this->CartModel->addToCart($userId, $productId, $qty);
        }

        echo json_encode(['success' => true, 'message' => 'Produk berhasil ditambahkan ke keranjang.']);
    }



    public function check_cart_empty()
    {
        $user_id = $this->session->userdata('user_id');
        $cart = $this->CartModel->getCartByUserId($user_id);
        // Sesuaikan dengan cara Anda memeriksa isi keranjang
        $response = [
            'empty' => empty($cart) // Jika keranjang kosong, `empty` = true
        ];
        echo json_encode($response);
    }



    public function getCartCount()
    {
        $userId = $this->session->userdata('user_id'); // Ambil ID user dari session


        $userId = $this->session->userdata('user_id');
        $cartCount = $this->CartModel->getCartItemCount($userId);
        echo json_encode(['count' => $cartCount]);
    }


    public function deleteItem()
    {
        $cartId = $this->input->post('id'); // Ambil id dari parameter yang dikirimkan lewat POST

        // Panggil model untuk menghapus item berdasarkan cartId
        $result = $this->CartModel->deleteCartItem($cartId);

        if ($result) {
            // Kirim respon sukses
            echo json_encode(['success' => true]);
        } else {
            // Kirim respon gagal
            echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan saat menghapus item.']);
        }
    }


    public function updateQty()
    {
        // Ambil data dari POST request
        $data = json_decode(file_get_contents("php://input"));

        $user_id = $data->user_id;
        $product_id = $data->product_id;
        $qty = $data->qty;
        $status = 1;

        // Periksa apakah user dan produk ada di database
        if ($this->CartModel->update_cart_quantity($user_id, $product_id, $qty, $status)) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }


    public function updateAllQty()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['cart_items'])) {
            foreach ($input['cart_items'] as $item) {
                $userId = $item['user_id'];
                $productId = $item['product_id'];
                $qty = $item['qty'];

                // Update database
                $this->db->where('user_id', $userId)
                    ->where('product_id', $productId)
                    ->where('status', 1)
                    ->update('cart', ['qty' => $qty]);
            }

            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
        }
    }





    // public function add()
    // {
    //     $productId = $this->input->post('product_id');
    //     $qty = $this->input->post('qty');

    //     // Cek apakah ID produk dan jumlah valid
    //     if (isset($productId) && isset($qty)) {
    //         $product = $this->ProduksModel->get_product_by_id_id($productId);

    //         // Cek stok produk
    //         if ($product && $product->qty >= $qty) {
    //             // Tambahkan produk ke keranjang menggunakan model
    //             $result = $this->CartModel->add_to_cart($productId, $qty);

    //             if ($result) {
    //                 // Kirim respons sukses
    //                 echo json_encode(['success' => true, 'message' => 'Produk berhasil ditambahkan ke keranjang.']);
    //             } else {
    //                 // Kirim respons gagal
    //                 echo json_encode(['success' => false, 'message' => 'Gagal menambahkan produk ke keranjang.']);
    //             }
    //         } else {
    //             // Kirim pesan stok tidak mencukupi
    //             echo json_encode(['success' => false, 'message' => 'Stok tidak mencukupi.']);
    //         }
    //     } else {
    //         // Kirim respons jika data tidak lengkap
    //         echo json_encode(['success' => false, 'message' => 'Data tidak lengkap.']);
    //     }
    // }
}

/* End of file CartController.php */
