<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Seller;

class SellerTransactionController extends ApiController
{
    public function index(Seller $seller)
    {
        $transactions = $seller->products()
                                ->whereHas('transactions')
                                ->with('transactions')
                                ->get()
                                ->pluck('transactions')
                                ->unique('id')
                                ->values();
        return $this->ShowAll($transactions);
    }
}
