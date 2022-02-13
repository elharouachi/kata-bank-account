<?php

namespace App\model;

use App\Model;

class History extends Model
{
    private array $transactionList = [];

    public function __construct($transactionList = []) {
        $this->transactionList = $transactionList;
    }

    public function appendTransaction(Transaction $transaction) {
        $this->transactionList[] = $transaction;
    }

    public function getTransactionList(): array {
        return $this->transactionList;
    }
}
