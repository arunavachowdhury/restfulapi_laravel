<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Category;
use App\Product;

class ProductCategoryController extends ApiController
{
    public function index(Product $product)
    {
        $categories = $product->categories;
        return $this->ShowAll($categories);
    }
}
