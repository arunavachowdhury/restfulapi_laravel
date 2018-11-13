<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Transaction;

class TransactionSellerController extends ApiController
{
    public function index(Transaction $transaction)
    {
        $seller = $transaction->product->seller;
        return $this->ShowOne($seller);
    }
}
