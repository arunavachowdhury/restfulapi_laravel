<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Buyer;

class BuyerTransactionController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(Buyer $buyer)
    {
        $transactions = $buyer->transactions;
        return $this->ShowAll($transactions); 
    }
}
