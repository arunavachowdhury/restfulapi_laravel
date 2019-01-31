<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Category;

class CategoryBuyerController extends ApiController
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(Category $category)
    {
        $buyer =$category->products()
        ->whereHas('transactions')
        ->with('transactions.buyer')
        ->get()
        ->pluck('transactions.buyer')
        ->collapse()
        ->pluck('buyer')
        ->unique('id')
        ->values();

        return $this->ShowAll($buyer);

    }
}