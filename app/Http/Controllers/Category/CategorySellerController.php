<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Category;

class CategorySellerController extends ApiController
{
    public function index(Category $category)
    {
        $seller = $category->products()
        ->with('seller')
        ->get()
        ->pluck('seller')
        ->unique('id')
        ->values();
        return $this->ShowAll($seller);
    }
}
