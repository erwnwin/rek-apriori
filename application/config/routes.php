<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Beranda';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['beranda'] = 'frontend/BerandaController/index';
$route['produk'] = 'frontend/ProdukController/index';
$route['produk/detail/(:any)'] = 'frontend/ProdukController/detail/$1';
$route['help'] = 'frontend/HelpController/index';

$route['logout'] = 'admin/LogoutController/logout';
$route['login'] = 'frontend/LoginController/index';
$route['login/act'] = 'frontend/LoginController/proses_login';
$route['register'] = 'frontend/RegisterController/index';
$route['forgot-password'] = 'frontend/ForgotPasswordController/index';
$route['auth/register'] = 'frontend/RegisterController/act_register';

// akses admin/superadmin
$route['dashboard'] = 'admin/DashboardController/index';
$route['produks'] = 'admin/ProdukController/index';
$route['publishers'] = 'admin/PublishersController/index';
$route['banks'] = 'admin/BanksController/index';
$route['regions'] = 'admin/RegionsControllers/index';
$route['customers'] = 'admin/customersController/index';
$route['employees'] = 'admin/EmployeesController/index';
$route['profile'] = 'admin/ProfilController/index';
$route['transaksi'] = 'admin/TransaksiController/index';
$route['transaksi/filter'] = 'admin/TransaksiController/filter';
$route['transaksi/filter-name'] = 'admin/TransaksiController/filter_auto';
$route['hasil'] = 'admin/HasilController/index';
$route['hasil/export'] = 'admin/HasilController/exportToExcel';
$route['proses-apriori'] = 'admin/AprioriController/index';
// $route['run-apriori'] = 'admin/AprioriController/runApriori';

// akses customer
$route['myhome'] = 'pelanggan/MyhomeController/index';
$route['books'] = 'pelanggan/BooksController/index';
$route['books/detail/(:any)'] = 'pelanggan/BooksController/detail/$1';
$route['books/detail/cart/getCartCount'] = 'pelanggan/CartController/getCartCount';
$route['cart'] = 'pelanggan/CartController/index';
$route['cart/add'] = 'pelanggan/CartController/add';
$route['cart/kosong'] = 'pelanggan/CartController/check_cart_empty';
$route['cart/getCartCount'] = 'pelanggan/CartController/getCartCount';
$route['cart/deleteItem'] = 'pelanggan/CartController/deleteItem';
$route['cart/updateQty'] = 'pelanggan/CartController/updateQty';
$route['cart/updateAllQty'] = 'pelanggan/CartController/updateAllQty';
// $route['checkout/process-checkout'] = 'pelanggan/CheckoutController/process_checkout';

$route['cart/checkout'] = 'payment/snap/index';
$route['snap/token'] = 'payment/snap/token';
$route['snap/token_continue'] = 'payment/snap/token_continue';
$route['snap/resumePayment'] = 'payment/snap/resumePayment';
$route['snap/updateTransactionStatus'] = 'payment/snap/updateTransactionStatus';
$route['snap/cancelAndContinuePayment'] = 'payment/snap/cancelAndContinuePayment';

$route['snap/cekStatusOrder'] = 'payment/snap/cekStatusOrder';
$route['snap/cancelPayment'] = 'payment/snap/cancelPayment';

$route['checkout/status'] = 'payment/snap/finish';

$route['history'] = 'payment/snap/showCheckoutStatus';

$route['account'] = 'pelanggan/AccountController/index';
