<?php
class Apriori
{
    private $transactions;
    private $min_support;

    public function __construct($transactions = [], $min_support = 2)
    {
        $this->transactions = $transactions;
        $this->min_support = $min_support;
    }

    // Hitung frekuensi itemset
    private function calculate_support($itemset)
    {
        $count = 0;
        foreach ($this->transactions as $transaction) {
            if (count(array_intersect($transaction, $itemset)) == count($itemset)) {
                $count++;
            }
        }
        return $count;
    }

    // Generate candidate itemsets
    private function generate_candidates($itemsets, $length)
    {
        $candidates = [];
        $count = count($itemsets);
        for ($i = 0; $i < $count; $i++) {
            for ($j = $i + 1; $j < $count; $j++) {
                $candidate = array_unique(array_merge($itemsets[$i], $itemsets[$j]));
                if (count($candidate) == $length) {
                    $candidates[] = $candidate;
                }
            }
        }
        return $candidates;
    }

    // Algoritma Apriori
    public function run()
    {
        $frequent_itemsets = [];
        $current_itemsets = [];

        // Langkah 1: Generate itemset tunggal
        foreach ($this->transactions as $transaction) {
            foreach ($transaction as $item) {
                $current_itemsets[] = [$item];
            }
        }
        $current_itemsets = array_unique($current_itemsets, SORT_REGULAR);

        $k = 1;
        while (!empty($current_itemsets)) {
            $next_itemsets = [];
            foreach ($current_itemsets as $itemset) {
                $support = $this->calculate_support($itemset);
                if ($support >= $this->min_support) {
                    $frequent_itemsets[] = $itemset;
                    $next_itemsets[] = $itemset;
                }
            }
            $k++;
            $current_itemsets = $this->generate_candidates($next_itemsets, $k);
        }

        return $frequent_itemsets;
    }
}
