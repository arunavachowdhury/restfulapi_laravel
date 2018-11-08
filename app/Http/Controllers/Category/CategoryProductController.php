<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Category;

class CategoryProductController extends ApiController
{
    public function index(Category $category)
    {
        $products = $category->products;
        return $this->ShowAll($products);
    }
}
