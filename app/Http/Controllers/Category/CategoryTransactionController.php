<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Category;

class CategoryTransactionController extends ApiController
{
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index(Category $category)
    {
        $transactions = $category->products()
        ->whereHas('transactions')
        ->with('transactions')
        ->get()
        ->pluck('transactions')
        ->unique('id')
        ->values();
        return $this->ShowAll($transactions);
    }
}
