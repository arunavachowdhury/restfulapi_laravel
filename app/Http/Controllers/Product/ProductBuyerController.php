<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Product;

class ProductBuyerController extends ApiController
{
    public function index(Product $product)
    {
        $buyer = $product->transactions()
        ->with('buyer')
        ->get()
        ->pluck('buyer')
        ->unique('id')
        ->values();
        return $this->ShowAll($buyer);
    }
}
