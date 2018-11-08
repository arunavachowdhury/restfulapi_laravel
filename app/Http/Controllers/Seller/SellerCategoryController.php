<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Seller;

class SellerCategoryController extends ApiController
{
    public function index(Seller $seller)
    {
        $categories = $seller->products()
                    ->with('categories')
                    ->get()
                    ->pluck('categories')
                    ->unique('id')
                    ->values();
        return $this->ShowAll($categories);
    }
}
