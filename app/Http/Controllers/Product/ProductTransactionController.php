<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Product;

class ProductTransactionController extends ApiController
{

    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(Product $product)
    {
        $transactions = $product->transactions;
        return $this->ShowAll($transactions);
    }
}
