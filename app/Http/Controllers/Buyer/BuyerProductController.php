<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Buyer;

class BuyerProductController extends ApiController
{
    public function index(Buyer $buyer)
    {
        $product = $buyer->transactions()->with('product')->get()->pluck('product')->unique('id')->values();
        return $this->ShowAll($product);
    }
}
