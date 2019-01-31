<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Buyer;

class BuyerCategoryController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Buyer $buyer)
    {
        $category = $buyer->transactions()
                            ->with('product.categories')
                            ->get()->pluck('product.categories')
                            ->collapse()
                            ->unique('id')
                            ->values();
        return $this->ShowAll($category);
    }    
}
