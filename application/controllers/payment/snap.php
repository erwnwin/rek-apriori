<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'libraries/Midtrans.php';

// use Midtrans\Config;
// use Midtrans\Transaction;


class Snap extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
	{
		parent::__construct();
		$params = array('server_key' => 'SB-Mid-server-54hGCcibaZiviQmtujHrrHh-', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');

		$this->load->model('CartModel');
		$this->load->model('ProduksModel');
		$this->load->model('UserModel');
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


		$user_id = $this->session->userdata('user_id');
		$cart = $this->CartModel->getCartByUserId($user_id);

		if (!$cart) {
			$this->session->set_flashdata('error', 'Cart kosong, tidak bisa melanjutkan checkout.');
			redirect(base_url('cart')); // Kembali ke halaman cart
		}

		// Hitung total cart
		$total_harga = array_sum(array_map(function ($item) {
			return $item->price * $item->qty;
		}, $cart));

		// Kirim data ke view checkout
		$data = [
			'cart' => $cart,
			'total_harga' => $total_harga
		];
		$data['title'] = 'Proses Checkout';

		$this->load->view('payment/template/head', $data);
		$this->load->view('payment/checkout_snap', $data);
		$this->load->view('payment/template/footer', $data);
	}


	// public function token()
	// {
	// 	$user_id = $this->session->userdata('user_id');
	// 	$cart = $this->CartModel->getCartByUserId($user_id);

	// 	if (empty($cart)) {
	// 		echo json_encode(['error' => 'Data cart tidak ditemukan.']);
	// 		return;
	// 	}

	// 	// Hitung total pembelian
	// 	$total_amount = $this->CartModel->calculateTotalPurchase($cart);

	// 	// Data pembayaran yang dikirim ke Midtrans
	// 	$transaction_details = [
	// 		'order_id' => uniqid('KMU#TR-'),
	// 		'gross_amount' => $total_amount,
	// 	];

	// 	// Data item yang ada di keranjang
	// 	$item_details = array_map(function ($item) {
	// 		return [
	// 			'id' => $item->id,
	// 			'price' => $item->price,
	// 			'quantity' => $item->qty,
	// 			'name' => $item->name,
	// 		];
	// 	}, $cart);

	// 	// Data pelanggan
	// 	$customer_details = [
	// 		'first_name' => $this->session->userdata('first_name'),
	// 		'email' => $this->session->userdata('email'),
	// 	];

	// 	// Konfigurasi parameter Snap
	// 	$snap_params = [
	// 		'transaction_details' => $transaction_details,
	// 		'item_details' => $item_details,
	// 		'customer_details' => $customer_details,
	// 	];

	// 	// Generate token menggunakan library Midtrans
	// 	try {
	// 		$snap_token = $this->midtrans->getSnapToken($snap_params);

	// 		// Simpan data transaksi awal ke database
	// 		$transaction_data = [
	// 			'id_transaction' => $transaction_details['order_id'],
	// 			'user_id' => $user_id,
	// 			'type_bayar' => 'Midtrans',
	// 			'total_pembelian' => $total_amount,
	// 			'status' => 'pending',
	// 			'tgl_transaksi' => date('Y-m-d H:i:s'),
	// 			'snap_token' => $snap_token,
	// 			'expired_at' => date("Y-m-d H:i:s", strtotime('+15 minutes')),
	// 		];
	// 		$this->db->insert('transactions_new', $transaction_data);

	// 		// Kirim token ke frontend
	// 		echo json_encode(['token' => $snap_token, 'order_id' => $transaction_details['order_id']]);
	// 	} catch (Exception $e) {
	// 		echo json_encode(['error' => $e->getMessage()]);
	// 	}
	// }

	// public function finish()
	// {
	// 	$result = json_decode($this->input->post('result_data'), true); // Decode JSON dari Midtrans
	// 	$transaction_id = $result['order_id'];
	// 	$transaction_status = $result['transaction_status'];

	// 	// Update status di database
	// 	$this->db->where('id_transaction', $transaction_id);
	// 	$this->db->update('transactions_new', ['status' => $transaction_status]);

	// 	// Redirect ke halaman sukses, gagal, atau pending
	// 	if ($transaction_status === 'settlement' || $transaction_status === 'capture') {
	// 		redirect('payment/success');
	// 	} elseif ($transaction_status === 'pending') {
	// 		redirect('payment/pending');
	// 	} else {
	// 		redirect('payment/error');
	// 	}
	// }


	public function token()
	{
		// Ambil data checkout
		$user_id = $this->session->userdata('user_id');
		$cart = $this->CartModel->getCartByUserId($user_id);
		$user = $this->UserModel->getUserById($user_id);

		if (empty($cart) || empty($user)) {
			echo json_encode(['error' => 'Data cart atau user tidak ditemukan.']);
			return;
		}

		// Hitung total harga
		$gross_amount = array_sum(array_map(fn($item) => $item->price * $item->qty, $cart));

		// Buat data transaksi
		$order_id = 'KMU#TR-' . time();
		$transaction_details = [
			'order_id' => $order_id, // Gunakan order_id unik
			'gross_amount' => $gross_amount, // Total harga
		];

		// Siapkan item details
		$item_details = array_map(function ($item) {
			return [
				'id' => $item->product_id,
				'price' => $item->price,
				'quantity' => $item->qty,
				'name' => $item->name,
			];
		}, $cart);

		// Buat data customer
		$customer_details = [
			'first_name' => $user->first_name,
			'last_name' => $user->last_name,
			'email' => $user->email,
			'phone' => $user->phone,
			'billing_address' => [
				'first_name' => $user->first_name,
				'last_name' => $user->last_name,
				'address' => $user->address,
				'phone' => $user->phone,
				'country_code' => 'IDN',
			],
			'shipping_address' => [
				'first_name' => $user->first_name,
				'last_name' => $user->last_name,
				'address' => $user->address,
				'phone' => $user->phone,
				'country_code' => 'IDN',
			],
		];

		// Siapkan data transaksi lengkap
		$credit_card = ['secure' => true];
		$custom_expiry = [
			'start_time' => date("Y-m-d H:i:s O", time()),
			'unit' => 'minute',
			'duration' => 15, // Masa berlaku token (15 menit)
		];

		$transaction_data = [
			'transaction_details' => $transaction_details,
			'item_details' => $item_details,
			'customer_details' => $customer_details,
			'credit_card' => $credit_card,
			'expiry' => $custom_expiry,
		];

		// Log untuk debug
		error_log(json_encode($transaction_data));

		// // Dapatkan token dari Midtrans
		$snapToken = $this->midtrans->getSnapToken($transaction_data);

		// $json = file_get_contents('php://input');
		// $result = json_decode($json, true);

		// Kembalikan token ke frontend
		echo json_encode(['token' => $snapToken, 'order_id' => $order_id]);
	}




	public function finish()
	{
		$result = json_decode($this->input->post('result_data'), true); // Decode JSON dari Midtrans
		$transaction_id = $result['order_id'];
		$transaction_status = $result['transaction_status'];
		$user_id = $this->session->userdata('user_id');
		$cart = $this->CartModel->getCartByUserId($user_id);


		if ($transaction_status === 'settlement') {
			$this->db->where('id_transaction', $transaction_id);
			$this->db->update('transactions_new', ['status' => 'settlement']);
		}

		if (empty($cart)) {
			echo json_encode(['error' => 'Data cart tidak ditemukan.']);
			return;
		}

		// Ambil detail transaksi dari Midtrans
		$order_id = $result['order_id'];
		$transaction_status = $result['transaction_status'] ?? 'unknown';

		// Cari transaksi berdasarkan `order_id`
		$existing_transaction = $this->db->get_where('transactions_new', ['id_transaction' => $order_id])->row();

		if ($existing_transaction) {
			// Update status jika transaksi sudah ada
			$this->db->where('id_transaction', $order_id);
			$this->db->update('transactions_new', ['status' => $transaction_status]);
		} else {
			// Buat transaksi baru jika belum ada
			$transaction_record = [
				'id_transaction' => $order_id,
				'user_id' => $user_id,
				'type_bayar' => 'Midtrans',
				'total_pembelian' => array_sum(array_map(fn($item) => $item->price * $item->qty, $cart)),
				'status' => $transaction_status,
				'tgl_transaksi' => date('Y-m-d H:i:s'),
				'expired_at' => date("Y-m-d H:i:s", strtotime('+15 minutes')),
			];
			$this->db->insert('transactions_new', $transaction_record);
		}

		// Update `transaction_id` di tabel cart
		foreach ($cart as $item) {
			$this->db->where('id', $item->id);
			$this->db->update('cart', [
				'transaction_id' => $order_id,
				'status' => 2,
			]);
		}

		// Redirect berdasarkan status
		if ($transaction_status === 'pending') {
			$data['title'] = 'Lanjutkan Pembayaran';
			$data['order_id'] = $order_id;

			$this->load->view('payment/template/head', $data);
			$this->load->view('payment/checkout/pending', $data);
			$this->load->view('payment/template/footer', $data);
		} elseif ($transaction_status === 'settlement' || $transaction_status === 'capture') {
			$data['title'] = 'Pembayaran Selesai';

			$this->load->view('payment/template/head', $data);
			$this->load->view('payment/checkout/success', $data);
			$this->load->view('payment/template/footer', $data);
		} else {
			$data['title'] = 'Gagal Melakukan Pembayaran';

			$this->load->view('payment/template/head', $data);
			$this->load->view('payment/checkout/gagal', $data);
			$this->load->view('payment/template/footer', $data);
		}
	}



	public function showCheckoutStatus()
	{
		// Ambil ID pengguna dari session
		$user_id = $this->session->userdata('user_id');

		if (!$user_id) {
			// Jika pengguna tidak login, redirect ke halaman login
			redirect(base_url('login'));
		}

		// Ambil status dan tanggal dari input (jika ada)
		$status = $this->input->get('status'); // status filter
		$date = $this->input->get('date');     // date filter

		// Ambil transaksi berdasarkan user_id dan filter
		$transactions = $this->CartModel->getTransactionsByFilters($user_id, $status, $date);

		// Pastikan ada transaksi yang ditemukan setelah filter
		if (empty($transactions)) {
			// Jika tidak ada transaksi, tampilkan pesan
			$this->session->set_flashdata('message', 'Tidak ada transaksi yang ditemukan.');
		}

		// Kirim data transaksi ke view
		$data['transactions'] = $transactions;
		$data['title'] = 'History Checkout';

		if ($this->input->is_ajax_request()) {
			$this->load->view('pelanggan/checkout/transaction_table', $data);
		} else {
			// Jika bukan AJAX, load halaman secara penuh
			$this->load->view('payment/template/head', $data);
			$this->load->view('pelanggan/checkout/checkout_status', $data);
			$this->load->view('payment/template/footer', $data);
		}
	}


	public function updateTransactionStatus()
	{
		// Ambil data status dari Midtrans
		$order_id = $this->input->post('order_id');
		$transaction_status = $this->input->post('transaction_status'); // status seperti 'settlement', 'pending', 'cancel', dll.

		if (!$order_id || !$transaction_status) {
			echo json_encode(['error' => 'Data tidak lengkap.']);
			return;
		}

		// Cari transaksi berdasarkan order_id
		$transaction = $this->db->get_where('transactions_new', ['id_transaction' => $order_id])->row();

		if ($transaction) {
			// Update status transaksi sesuai dengan status dari Midtrans
			$this->db->where('id_transaction', $order_id);

			switch ($transaction_status) {
				case 'settlement':
					$this->db->update('transactions_new', ['status' => 'settlement']);
					// Update status cart menjadi 2 (terbayar)
					$this->db->where('transaction_id', $order_id)->update('cart', ['status' => 2]);
					echo json_encode(['message' => 'Transaksi berhasil']);
					break;

				case 'pending':
					$this->db->update('transactions_new', ['status' => 'pending']);
					echo json_encode(['message' => 'Transaksi sedang dalam status pending']);
					break;

				case 'cancel':
					$this->db->update('transactions_new', ['status' => 'cancel']);
					echo json_encode(['message' => 'Transaksi dibatalkan']);
					break;

				case 'expire':
					$this->db->update('transactions_new', ['status' => 'expired']);
					echo json_encode(['message' => 'Transaksi kadaluarsa']);
					break;

				default:
					echo json_encode(['error' => 'Status transaksi tidak dikenali']);
					break;
			}
		} else {
			echo json_encode(['error' => 'Transaksi tidak ditemukan']);
		}
	}

	public function resumePayment()
	{
		$user_id = $this->session->userdata('user_id');
		if (!$user_id) {
			echo json_encode(['error' => 'User tidak ditemukan.']);
			return;
		}

		// Ambil data user berdasarkan user_id
		$user = $this->UserModel->getUserById($user_id);
		if (empty($user)) {
			echo json_encode(['error' => 'Data user tidak ditemukan.']);
			return;
		}

		// Periksa transaksi lama dengan status pending
		$transaction = $this->db->get_where('transactions_new', [
			'user_id' => $user_id,
			'status' => 'pending'
		])->row();

		if (!$transaction) {
			echo json_encode(['error' => 'Tidak ada transaksi pending untuk user ini.']);
			return;
		}

		// Ambil data cart berdasarkan user_id dan id_transaction
		$cart = $this->CartModel->getCartByUserIdAndTransaction($user_id, $transaction->id_transaction);

		if (empty($cart)) {
			echo json_encode(['error' => 'Data cart tidak ditemukan untuk transaksi ini.']);
			return;
		}

		// Hitung total pembelian dari cart
		$gross_amount = array_sum(array_map(fn($item) => $item->price * $item->qty, $cart));

		// Siapkan detail transaksi dan item cart
		$transaction_details = [
			'order_id' => $transaction->id_transaction, // Gunakan order_id dari transaksi yang sudah ada
			'gross_amount' => $gross_amount,
		];

		$item_details = array_map(function ($item) {
			return [
				'id' => $item->product_id,
				'price' => $item->price,
				'quantity' => $item->qty,
				'name' => $item->name,
			];
		}, $cart);

		$customer_details = [
			'first_name' => $user->first_name,
			'last_name' => $user->last_name,
			'email' => $user->email,
			'phone' => $user->phone,
			'billing_address' => [
				'first_name' => $user->first_name,
				'last_name' => $user->last_name,
				'address' => $user->address,
				'phone' => $user->phone,
				'country_code' => 'IDN',
			],
			'shipping_address' => [
				'first_name' => $user->first_name,
				'last_name' => $user->last_name,
				'address' => $user->address,
				'phone' => $user->phone,
				'country_code' => 'IDN',
			],
		];

		// Siapkan data transaksi lengkap
		$credit_card = ['secure' => true];
		$custom_expiry = [
			'start_time' => date("Y-m-d H:i:s O", time()),
			'unit' => 'minute',
			'duration' => 15,
		];

		$transaction_data = [
			'transaction_details' => $transaction_details,
			'item_details' => $item_details,
			'customer_details' => $customer_details,
			'credit_card' => $credit_card,
			'expiry' => $custom_expiry,
		];

		try {
			// Dapatkan token Snap dari Midtrans
			$snapToken = $this->midtrans->getSnapToken($transaction_data);

			// Update transaksi yang sudah ada
			$this->db->where('id_transaction', $transaction->id_transaction)
				->update('transactions_new', [
					'status' => 'pending', // Tetap status pending atau sesuai dengan status pembayaran
					'total_pembelian' => $gross_amount,
					'expired_at' => date('Y-m-d H:i:s', strtotime('+15 minutes')), // Perpanjang waktu
				]);

			// Kembalikan token Snap dan order_id ke frontend
			echo json_encode(['token' => $snapToken, 'order_id' => $transaction->id_transaction]);
		} catch (Exception $e) {
			echo json_encode(['error' => 'Gagal melanjutkan transaksi. Error: ' . $e->getMessage()]);
		}
	}





	// public function resumePayment()
	// {
	// 	$user_id = $this->session->userdata('user_id');
	// 	if (!$user_id) {
	// 		echo json_encode(['error' => 'User tidak ditemukan.']);
	// 		return;
	// 	}

	// 	// Ambil data user dan cart berdasarkan user_id
	// 	$user = $this->UserModel->getUserById($user_id);
	// 	$cart = $this->CartModel->getCartByUserId($user_id);

	// 	if (empty($cart) || empty($user)) {
	// 		echo json_encode(['error' => 'Data cart atau user tidak ditemukan.']);
	// 		return;
	// 	}

	// 	// Periksa transaksi lama dengan status pending
	// 	$transaction = $this->db->get_where('transactions_new', [
	// 		'user_id' => $user_id,
	// 		'status' => 'pending'
	// 	])->row();

	// 	// Buat transaksi baru
	// 	$order_id = 'KMU#TR-' . time();
	// 	$gross_amount = array_sum(array_map(fn($item) => $item->price * $item->qty, $cart));

	// 	$payment_status = $this->verifyPaymentStatus($order_id);

	// 	// Siapkan detail transaksi dan item cart
	// 	$transaction_details = [
	// 		'order_id' => $order_id,
	// 		'gross_amount' => $gross_amount,
	// 	];

	// 	$item_details = array_map(function ($item) {
	// 		return [
	// 			'id' => $item->product_id,
	// 			'price' => $item->price,
	// 			'quantity' => $item->qty,
	// 			'name' => $item->name,
	// 		];
	// 	}, $cart);

	// 	$customer_details = [
	// 		'first_name' => $user->first_name,
	// 		'last_name' => $user->last_name,
	// 		'email' => $user->email,
	// 		'phone' => $user->phone,
	// 		'billing_address' => [
	// 			'first_name' => $user->first_name,
	// 			'last_name' => $user->last_name,
	// 			'address' => $user->address,
	// 			'phone' => $user->phone,
	// 			'country_code' => 'IDN',
	// 		],
	// 		'shipping_address' => [
	// 			'first_name' => $user->first_name,
	// 			'last_name' => $user->last_name,
	// 			'address' => $user->address,
	// 			'phone' => $user->phone,
	// 			'country_code' => 'IDN',
	// 		],
	// 	];

	// 	// Siapkan data transaksi lengkap
	// 	$credit_card = ['secure' => true];
	// 	$custom_expiry = [
	// 		'start_time' => date("Y-m-d H:i:s O", time()),
	// 		'unit' => 'minute',
	// 		'duration' => 15,
	// 	];

	// 	$transaction_data = [
	// 		'transaction_details' => $transaction_details,
	// 		'item_details' => $item_details,
	// 		'customer_details' => $customer_details,
	// 		'credit_card' => $credit_card,
	// 		'expiry' => $custom_expiry,
	// 	];

	// 	try {
	// 		// Dapatkan token Snap dari Midtrans
	// 		$snapToken = $this->midtrans->getSnapToken($transaction_data);


	// 		// Simpan transaksi baru ke tabel `transactions_new`
	// 		$this->db->insert('transactions_new', [
	// 			'id_transaction' => $order_id,
	// 			'user_id' => $user_id,
	// 			'total_pembelian' => $gross_amount,
	// 			'type_bayar' => 'Midtrans', // Menyimpan jenis pembayaran lengkap
	// 			'status' => $payment_status,
	// 			'tgl_transaksi' => date('Y-m-d H:i:s'),
	// 			'expired_at' => date('Y-m-d H:i:s', strtotime('+15 minutes')),
	// 		]);

	// 		// Update `transaction_id` pada cart yang memiliki `transaction_id` lama
	// 		if ($transaction) {
	// 			// Update hanya cart yang memiliki `transaction_id` lama
	// 			$this->db->where('transaction_id', $transaction->id_transaction)
	// 				->update(
	// 					'cart',
	// 					[
	// 						'transaction_id' => $order_id,
	// 						'status' => 2 // Status cart menjadi 'terbayar'
	// 					]
	// 				);

	// 			// Hapus transaksi lama dari tabel `transactions_new`
	// 			$this->db->where('id_transaction', $transaction->id_transaction)
	// 				->delete('transactions_new');

	// 			// Hapus item cart yang terkait dengan transaksi lama
	// 			$this->db->where('transaction_id', $transaction->id_transaction)
	// 				->delete('cart');
	// 		}

	// 		// Verifikasi status pembayaran dari Midtrans


	// 		// Kembalikan token Snap dan order_id ke frontend
	// 		echo json_encode(['token' => $snapToken, 'order_id' => $order_id]);
	// 	} catch (Exception $e) {
	// 		echo json_encode(['error' => 'Gagal membuat transaksi baru. Error: ' . $e->getMessage()]);
	// 	}
	// }

	private function verifyPaymentStatus($order_id)
	{
		try {
			// Memverifikasi status transaksi menggunakan Midtrans API
			$status = $this->midtrans->status($order_id); // Memanggil API status Midtrans

			// Periksa status transaksi dari Midtrans
			if ($status->transaction_status === 'settlement') {
				// Pembayaran berhasil, update status transaksi
				$this->db->where('id_transaction', $order_id)
					->update('transactions_new', ['status' => 'settlement']);

				// Update status cart menjadi 'terbayar' (status = 2)
				$this->db->where('transaction_id', $order_id)
					->update('cart', ['status' => 2]);

				return 'settlement'; // Pembayaran berhasil
			} elseif ($status->transaction_status === 'expire') {
				// Pembayaran telah kedaluwarsa, update status transaksi
				$this->db->where('id_transaction', $order_id)
					->update('transactions_new', ['status' => 'expire']);

				// Update status cart menjadi 'kedaluwarsa' (status = 3)
				$this->db->where('transaction_id', $order_id)
					->update('cart', ['status' => 3]);

				return 'expire'; // Transaksi kedaluwarsa
			} elseif ($status->transaction_status === 'pending') {
				// Pembayaran belum selesai, tetap pending
				return 'pending'; // Status tetap pending
			} else {
				// Tangani status lainnya seperti cancel, deny, atau lainnya
				$this->db->where('id_transaction', $order_id)
					->update('transactions_new', ['status' => $status->transaction_status]);

				return $status->transaction_status; // Status lainnya
			}
		} catch (Exception $e) {
			// Tangani kesalahan saat memverifikasi status
			return 'error'; // Jika gagal memverifikasi status
		}
	}




	// public function resumePayment()
	// {
	// 	// $result = json_decode($this->input->post('result_data'), true); // Decode JSON dari Midtrans
	// 	// $transaction_status = $result['transaction_status'];

	// 	$user_id = $this->session->userdata('user_id');
	// 	if (!$user_id) {
	// 		echo json_encode(['error' => 'User tidak ditemukan.']);
	// 		return;
	// 	}

	// 	// Ambil data user dan cart berdasarkan user_id
	// 	$user = $this->UserModel->getUserById($user_id);
	// 	$cart = $this->CartModel->getCartByUserId2($user_id);

	// 	if (empty($cart) || empty($user)) {
	// 		echo json_encode(['error' => 'Data cart atau user tidak ditemukan.']);
	// 		return;
	// 	}

	// 	// Periksa transaksi lama dengan status pending
	// 	$transaction = $this->db->get_where('transactions_new', [
	// 		'user_id' => $user_id,
	// 		'status' => 'pending'
	// 	])->row();

	// 	// Buat transaksi baru
	// 	$order_id = 'KMU#TR-' . time();
	// 	$gross_amount = array_sum(array_map(fn($item) => $item->price * $item->qty, $cart));

	// 	// Siapkan detail transaksi dan item cart
	// 	$transaction_details = [
	// 		'order_id' => $order_id,
	// 		'gross_amount' => $gross_amount,
	// 	];

	// 	$item_details = array_map(function ($item) {
	// 		return [
	// 			'id' => $item->product_id,
	// 			'price' => $item->price,
	// 			'quantity' => $item->qty,
	// 			'name' => $item->name,
	// 		];
	// 	}, $cart);

	// 	$customer_details = [
	// 		'first_name' => $user->first_name,
	// 		'last_name' => $user->last_name,
	// 		'email' => $user->email,
	// 		'phone' => $user->phone,
	// 		'billing_address' => [
	// 			'first_name' => $user->first_name,
	// 			'last_name' => $user->last_name,
	// 			'address' => $user->address,
	// 			'phone' => $user->phone,
	// 			'country_code' => 'IDN',
	// 		],
	// 		'shipping_address' => [
	// 			'first_name' => $user->first_name,
	// 			'last_name' => $user->last_name,
	// 			'address' => $user->address,
	// 			'phone' => $user->phone,
	// 			'country_code' => 'IDN',
	// 		],
	// 	];

	// 	// Siapkan data transaksi lengkap
	// 	$credit_card = ['secure' => true];
	// 	$custom_expiry = [
	// 		'start_time' => date("Y-m-d H:i:s O", time()),
	// 		'unit' => 'minute',
	// 		'duration' => 15,
	// 	];

	// 	$transaction_data = [
	// 		'transaction_details' => $transaction_details,
	// 		'item_details' => $item_details,
	// 		'customer_details' => $customer_details,
	// 		'credit_card' => $credit_card,
	// 		'expiry' => $custom_expiry,
	// 	];

	// 	try {
	// 		// Dapatkan token Snap dari Midtrans
	// 		$snapToken = $this->midtrans->getSnapToken($transaction_data);


	// 		// $result = json_decode($this->input->post('result_data'), true); // Decode JSON dari Midtrans
	// 		// $transaction_status = $result['transaction_status'];

	// 		// // Simpan transaksi baru ke tabel `transactions_new`
	// 		$this->db->insert('transactions_new', [
	// 			'id_transaction' => $order_id,
	// 			'user_id' => $user_id,
	// 			'total_pembelian' => $gross_amount,
	// 			'type_bayar' => 'Midtrans', // Menyimpan jenis pembayaran lengkap
	// 			'status' => 'pending',
	// 			'tgl_transaksi' => date('Y-m-d H:i:s'),
	// 			'expired_at' => date('Y-m-d H:i:s', strtotime('+15 minutes')),
	// 		]);

	// 		// Update `transaction_id` pada cart yang memiliki `transaction_id` lama
	// 		if ($transaction) {
	// 			// Update hanya cart yang memiliki `transaction_id` lama
	// 			$this->db->where('transaction_id', $transaction->id_transaction)
	// 				->update(
	// 					'cart',
	// 					[
	// 						'transaction_id' => $order_id,
	// 						'status' => 2
	// 					]
	// 				);



	// 			// Hapus transaksi lama dari tabel `transactions_new`
	// 			$this->db->where('id_transaction', $transaction->id_transaction)
	// 				->delete('transactions_new');

	// 			// Hapus item cart yang terkait dengan transaksi lama
	// 			$this->db->where('transaction_id', $transaction->id_transaction)
	// 				->delete('cart');
	// 		}

	// 		// Kembalikan token Snap dan order_id ke frontend
	// 		echo json_encode(['token' => $snapToken, 'order_id' => $order_id]);
	// 	} catch (Exception $e) {
	// 		echo json_encode(['error' => 'Gagal membuat transaksi baru. Error: ' . $e->getMessage()]);
	// 	}
	// }



	public function confirmPayment()
	{
		$order_id = $this->input->post('order_id');
		$status = $this->input->post('status');
		$user_id = $this->session->userdata('user_id');

		if (!$order_id || !$status || !$user_id) {
			echo json_encode(['error' => 'Data tidak lengkap.']);
			return;
		}

		// Cek apakah transaksi dengan order_id tersebut ada
		$transaction = $this->db->get_where('transactions_new', ['id_transaction' => $order_id])->row();

		if ($transaction) {
			if ($status == 'settlement') {
				// Update status transaksi menjadi settlement jika pembayaran sukses
				$this->db->where('id_transaction', $order_id)
					->update('transactions_new', ['status' => 'settlement']); // Pembayaran sukses

				// Update status cart jika pembayaran sukses
				$this->db->where('transaction_id', $order_id)
					->update('cart', ['status' => 2]); // Cart status 2 artinya sudah terbayar
			} else {
				// Jika status bukan settlement, status tetap pending atau dibatalkan
				$this->db->where('id_transaction', $order_id)
					->update('transactions_new', ['status' => 'pending']); // Atau bisa 'cancel' jika gagal
			}

			echo json_encode(['message' => 'Status transaksi diperbarui']);
		} else {
			echo json_encode(['error' => 'Transaksi tidak ditemukan']);
		}
	}


	public function cancelPayment()
	{
		$order_id = $this->input->post('order_id');
		$user_id = $this->session->userdata('user_id');

		if (!$order_id || !$user_id) {
			echo json_encode(['error' => 'Order ID atau User tidak ditemukan.']);
			return;
		}

		// Cek apakah transaksi dengan order_id tersebut ada
		$transaction = $this->db->get_where('transactions_new', ['id_transaction' => $order_id])->row();

		if ($transaction) {
			// Update status transaksi menjadi "batal" atau "pending"
			$this->db->where('id_transaction', $order_id)
				->update('transactions_new', ['status' => 'pending']); // atau status lainnya

			// Update status cart jika diperlukan
			$this->db->where('transaction_id', $order_id)
				->update('cart', ['status' => 2]); // Set status cart kembali ke status yang sesuai (misalnya 0 = belum dibayar)

			echo json_encode(['message' => 'Transaksi dibatalkan']);
		} else {
			echo json_encode(['error' => 'Transaksi tidak ditemukan']);
		}
	}


	public function cancelAndContinuePayment()
	{
		// Ambil transaction_id dari POST
		$transaction_id = $this->input->post('transaction_id');

		// Pastikan transaction_id ada dan valid
		if (!$transaction_id) {
			redirect('cart'); // Redirect jika tidak ada transaction_id
		}

		// Ambil data transaksi berdasarkan transaction_id
		$this->db->where('id_transaction', $transaction_id);
		$transaction = $this->db->get('transactions_new')->row();

		// Cek apakah transaksi ditemukan
		if (!$transaction) {
			redirect('cart'); // Redirect jika transaksi tidak ditemukan
		}

		// Cek apakah transaksi sudah expired
		$current_time = date("Y-m-d H:i:s"); // Waktu saat ini
		if (strtotime($transaction->expired_at) < strtotime($current_time)) {
			// Jika expired, update status menjadi 'expired'
			$this->db->where('id_transaction', $transaction_id);
			$this->db->update('transactions_new', ['status' => 'expired']);

			// Hapus data cart yang memiliki transaction_id yang sama
			$this->db->where('transaction_id', $transaction_id);
			$this->db->delete('cart');  // Hapus baris cart yang memiliki transaction_id yang kedaluwarsa

			// Redirect ke halaman cart dan beri notifikasi expired
			$this->session->set_flashdata('message', 'Transaksi telah kedaluwarsa.');
			redirect('cart');
		}

		// Jika belum expired, hapus transaksi dan update cart
		$this->db->where('id_transaction', $transaction_id);
		$this->db->delete('transactions_new');

		// Hapus transaction_id di tabel cart
		$this->db->where('transaction_id', $transaction_id);
		$this->db->update('cart', ['transaction_id' => NULL, 'status' => 1]); // Mengubah status kembali ke status awal, misal 1 (belum dibayar)

		// Redirect kembali ke halaman cart untuk memulai proses pembayaran ulang
		redirect('cart');
	}


	public function filterTransactions()
	{
		// Ambil filter dari request
		$status = $this->input->get('status');
		$date = $this->input->get('date');

		// Ambil user_id dari session
		$user_id = $this->session->userdata('user_id'); // Pastikan user_id disimpan dalam session saat login

		// Mulai query untuk mengambil transaksi
		$this->db->select('*');
		$this->db->from('transactions_new');
		$this->db->where('user_id', $user_id); // Hanya ambil transaksi milik user yang sedang login

		// Filter berdasarkan status jika ada
		if ($status) {
			$this->db->where('status', $status);
		}

		// Filter berdasarkan tanggal jika ada
		if ($date) {
			$this->db->where('DATE(created_at)', $date); // Sesuaikan dengan nama kolom tanggal di database
		}

		// Ambil data transaksi yang disaring
		$transactions = $this->db->get()->result();

		// Load view dan kirimkan data transaksi
		$data['transactions'] = $transactions;
		// $this->load->view('transaction_table', $data); // Pastikan Anda membuat view untuk tabel
	}



	public function cekStatusOrder()
	{
		// Ambil transaction_id dari request POST
		$transaction_id = $this->input->post('transaction_id');

		// Cek apakah transaction_id ada
		if (!$transaction_id) {
			echo json_encode(['status' => 'error', 'message' => 'Transaction ID tidak ditemukan.']);
			return;
		}

		// Ambil data transaksi berdasarkan transaction_id
		$transaction = $this->db->get_where('transactions_new', ['id_transaction' => $transaction_id])->row();

		// Jika transaksi ditemukan, periksa status_order
		if ($transaction) {
			// Kirim status_order ke frontend
			echo json_encode(['status_kirim' => $transaction->status_kirim]);
		} else {
			echo json_encode(['status' => 'error', 'message' => 'Transaksi tidak ditemukan.']);
		}
	}








	// // Ambil Snap Token baru dari Midtrans
	// try {
	// 	$snapToken = $this->midtrans->getSnapToken($transaction_data);

	// 	// Simpan token baru ke database
	// 	$this->db->where('id_transaction', $order_id)
	// 		->update('transactions_new', ['snap_token' => $snapToken]);

	// 	// Kembalikan token untuk frontend
	// 	echo json_encode(['token' => $snapToken]);
	// } catch (Exception $e) {
	// 	echo json_encode(['error' => 'Gagal mendapatkan token pembayaran. Error: ' . $e->getMessage()]);
	// }







	// public function checkTransactionStatus($order_id)
	// {
	// 	// Gunakan library Midtrans untuk memeriksa status transaksi
	// 	$status = $this->midtrans->status($order_id);

	// 	if ($status->transaction_status === 'expire') {
	// 		return 'expired';
	// 	} elseif ($status->transaction_status === 'pending') {
	// 		return 'pending';
	// 	} elseif ($status->transaction_status === 'settlement') {
	// 		return 'settlement';
	// 	} else {
	// 		return $status->transaction_status;
	// 	}
	// }




	// public function token()
	// {

	// 	// Required
	// 	$transaction_details = array(
	// 		'order_id' => rand(),
	// 		'gross_amount' => 94000, // no decimal allowed for creditcard
	// 	);

	// 	// Optional
	// 	$item1_details = array(
	// 		'id' => 'a1',
	// 		'price' => 18000,
	// 		'quantity' => 3,
	// 		'name' => "Apple"
	// 	);

	// 	// Optional
	// 	$item2_details = array(
	// 		'id' => 'a2',
	// 		'price' => 20000,
	// 		'quantity' => 2,
	// 		'name' => "Orange"
	// 	);

	// 	// Optional
	// 	$item_details = array($item1_details, $item2_details);

	// 	// Optional
	// 	$billing_address = array(
	// 		'first_name'    => "Andri",
	// 		'last_name'     => "Litani",
	// 		'address'       => "Mangga 20",
	// 		'city'          => "Jakarta",
	// 		'postal_code'   => "16602",
	// 		'phone'         => "081122334455",
	// 		'country_code'  => 'IDN'
	// 	);

	// 	// Optional
	// 	$shipping_address = array(
	// 		'first_name'    => "Obet",
	// 		'last_name'     => "Supriadi",
	// 		'address'       => "Manggis 90",
	// 		'city'          => "Jakarta",
	// 		'postal_code'   => "16601",
	// 		'phone'         => "08113366345",
	// 		'country_code'  => 'IDN'
	// 	);

	// 	// Optional
	// 	$customer_details = array(
	// 		'first_name'    => "Andri",
	// 		'last_name'     => "Litani",
	// 		'email'         => "andri@litani.com",
	// 		'phone'         => "081122334455",
	// 		'billing_address'  => $billing_address,
	// 		'shipping_address' => $shipping_address
	// 	);

	// 	// Data yang akan dikirim untuk request redirect_url.
	// 	$credit_card['secure'] = true;
	// 	//ser save_card true to enable oneclick or 2click
	// 	//$credit_card['save_card'] = true;

	// 	$time = time();
	// 	$custom_expiry = array(
	// 		'start_time' => date("Y-m-d H:i:s O", $time),
	// 		'unit' => 'minute',
	// 		'duration'  => 2
	// 	);

	// 	$transaction_data = array(
	// 		'transaction_details' => $transaction_details,
	// 		'item_details'       => $item_details,
	// 		'customer_details'   => $customer_details,
	// 		'credit_card'        => $credit_card,
	// 		'expiry'             => $custom_expiry
	// 	);

	// 	error_log(json_encode($transaction_data));
	// 	$snapToken = $this->midtrans->getSnapToken($transaction_data);
	// 	error_log($snapToken);
	// 	echo $snapToken;
	// }


}
