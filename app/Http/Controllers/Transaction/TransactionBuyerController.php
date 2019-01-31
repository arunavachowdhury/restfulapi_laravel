<?php

namespace App\Http\Controllers\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Transaction;

class TransactionBuyerController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(Transaction $transaction)
    {
        $buyer = $transaction->buyer;
        return $this->ShowOne($buyer);
    }
}
