<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Buyer;


class BuyerSellerController extends ApiController
{
    public function index(Buyer $buyer)
    {
        $seller = $buyer->transactions()->with('product.seller')->get()->pluck('product.seller');
        return $this->ShowAll($seller);
    }
}
