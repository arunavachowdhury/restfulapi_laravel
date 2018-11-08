<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Seller;

class SellerBuyerController extends ApiController
{
    public function index(Seller $seller)
    {
        $buyer = $seller->products()
                        ->whereHas('transactions')
                        ->with('transactions.buyer')
                        ->get()
                        ->pluck('transactions')
                        ->collapse()
                        ->pluck('buyer')
                        ->unique('id')
                        ->values();
        return $this->ShowAll($buyer);                
    }
}
