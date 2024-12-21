<?php

class Midtrans_api
{
    public function __construct()
    {
        \Midtrans\Config::$serverKey = config_item('midtrans_server_key');
        \Midtrans\Config::$isProduction = config_item('midtrans_is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }

    // Membuat transaksi pembayaran
    public function charge($params)
    {
        try {
            $response = \Midtrans\CoreApi::charge($params);
            return $response;
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
