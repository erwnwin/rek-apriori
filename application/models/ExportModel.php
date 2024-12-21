<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ExportModel extends CI_Model
{
    // Mengambil data transaksi
    public function getTransactions()
    {
        $query = $this->db->select('id_transaction, GROUP_CONCAT(id_product) as produk')
            ->group_by('id_transaction')
            ->get('cart2');
        $result = [];
        foreach ($query->result() as $row) {
            $result[$row->id_transaction] = explode(',', $row->produk);
        }
        return $result;
    }

    // Menghitung support tiap produk
    public function getProductSupport()
    {
        $query = $this->db->select('id_product, COUNT(*) as qty')
            ->group_by('id_product')
            ->get('cart2');
        $totalTransactions = $this->db->count_all('cart2');

        $support = [];
        foreach ($query->result() as $row) {
            $support[$row->id_product] = $row->qty / $totalTransactions;
        }
        return $support;
    }

    // Menghitung support pasangan produk
    public function getPairSupport()
    {
        $transactions = $this->getTransactions();
        $pairCounts = [];
        foreach ($transactions as $products) {
            $pairs = $this->generatePairs($products);
            foreach ($pairs as $pair) {
                sort($pair); // Pastikan pasangan selalu dalam urutan yang sama
                $key = implode(',', $pair);
                if (!isset($pairCounts[$key])) {
                    $pairCounts[$key] = 0;
                }
                $pairCounts[$key]++;
            }
        }
        return $pairCounts;
    }

    // Menghasilkan pasangan produk
    private function generatePairs($products)
    {
        $pairs = [];
        $count = count($products);
        for ($i = 0; $i < $count; $i++) {
            for ($j = $i + 1; $j < $count; $j++) {
                $pairs[] = [$products[$i], $products[$j]];
            }
        }
        return $pairs;
    }

    // Menghitung rekomendasi dengan confidence
    public function getRecommendations()
    {
        $pairSupport = $this->getPairSupport();
        $productSupport = $this->getProductSupport();
        $recommendations = [];

        foreach ($pairSupport as $pair => $count) {
            list($productA, $productB) = explode(',', $pair);
            $confidence = $count / (isset($productSupport[$productA]) ? $productSupport[$productA] * count($this->getTransactions()) : 1);
            if ($confidence >= 0.5) { // Atur minimum confidence
                $recommendations[] = [
                    'product_main' => $productA,
                    'recommendation' => $productB,
                    'confidence' => $confidence * 100,
                ];
            }
        }
        return $recommendations;
    }
}

/* End of file ExportModel.php */
