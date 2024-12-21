<?php

defined('BASEPATH') or exit('No direct script access allowed');

class LibApriori
{
    private $transactions = [];
    private $min_support;
    private $min_confidence;

    public function __construct($transactions, $min_support, $min_confidence)
    {
        $this->transactions = $transactions;
        $this->min_support = $min_support;
        $this->min_confidence = $min_confidence;
    }

    public function run()
    {
        $frequent_itemsets = $this->generate_frequent_itemsets();
        $rules = $this->generate_rules($frequent_itemsets);
        return $rules;
    }

    private function generate_frequent_itemsets()
    {
        $frequent_itemsets = [];
        $items = $this->get_unique_items();

        // Step 1: Generate frequent 1-itemsets
        $candidates = $this->generate_candidates([$items]);
        $frequent_itemsets[1] = $this->filter_candidates($candidates);

        $k = 2;
        while (!empty($frequent_itemsets[$k - 1])) {
            // Step 2: Generate candidate k-itemsets
            $candidates = $this->generate_candidates(array_keys($frequent_itemsets[$k - 1]));

            // Step 3: Filter candidates by support
            $frequent_itemsets[$k] = $this->filter_candidates($candidates);

            $k++;
        }

        // Remove empty levels
        return array_filter($frequent_itemsets);
    }

    private function generate_candidates($itemsets)
    {
        $candidates = [];
        $item_count = count($itemsets);

        for ($i = 0; $i < $item_count; $i++) {
            for ($j = $i + 1; $j < $item_count; $j++) {
                $candidate = array_unique(array_merge((array) $itemsets[$i], (array) $itemsets[$j]));
                sort($candidate);
                $candidates[] = $candidate;
            }
        }

        return $candidates;
    }

    private function filter_candidates($candidates)
    {
        $frequent = [];
        $transaction_count = count($this->transactions);

        foreach ($candidates as $candidate) {
            $count = 0;

            foreach ($this->transactions as $transaction) {
                if ($this->is_subset($candidate, $transaction)) {
                    $count++;
                }
            }

            $support = $count / $transaction_count;

            if ($support >= $this->min_support) {
                $frequent[implode(',', $candidate)] = $support;
            }
        }

        return $frequent;
    }

    private function generate_rules($frequent_itemsets)
    {
        $rules = [];

        foreach ($frequent_itemsets as $k => $itemsets) {
            if ($k < 2) continue;

            foreach ($itemsets as $itemset => $support) {
                $items = explode(',', $itemset);

                $subsets = $this->get_non_empty_subsets($items);

                foreach ($subsets as $subset) {
                    $remaining = array_diff($items, $subset);

                    if (!empty($remaining)) {
                        $confidence = $support / $this->calculate_support($subset);

                        if ($confidence >= $this->min_confidence) {
                            $rules[] = [
                                'antecedent' => $subset,
                                'consequent' => $remaining,
                                'support' => $support,
                                'confidence' => $confidence
                            ];
                        }
                    }
                }
            }
        }

        return $rules;
    }

    private function get_unique_items()
    {
        $unique_items = [];

        foreach ($this->transactions as $transaction) {
            $unique_items = array_unique(array_merge($unique_items, $transaction));
        }

        sort($unique_items);
        return $unique_items;
    }

    private function is_subset($subset, $set)
    {
        return empty(array_diff($subset, $set));
    }

    private function calculate_support($subset)
    {
        $count = 0;

        foreach ($this->transactions as $transaction) {
            if ($this->is_subset($subset, $transaction)) {
                $count++;
            }
        }

        return $count / count($this->transactions);
    }

    private function get_non_empty_subsets($items)
    {
        $subsets = [];
        $count = count($items);

        for ($i = 1; $i < (1 << $count); $i++) {
            $subset = [];

            for ($j = 0; $j < $count; $j++) {
                if ($i & (1 << $j)) {
                    $subset[] = $items[$j];
                }
            }

            $subsets[] = $subset;
        }

        return $subsets;
    }
}




/* End of file LibraryName.php */
