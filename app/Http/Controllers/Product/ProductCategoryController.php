<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Category;
use App\Product;

class ProductCategoryController extends ApiController
{
    public function __construct()
    {
        $this->middleware('client.credentials')->only('index');
    }
    
    public function index(Product $product)
    {
        $categories = $product->categories;
        return $this->ShowAll($categories);
    }

    public function update(Request $request, Product $product, Category $category)
    {
        $product->categories()->syncWithoutDetaching([$category->id]);
        return $this->ShowAll($product->categories);
    }

    public function destroy(Request $request, Product $product, Category $category)
    {
        $product->categories()->detach($category->id);
        return $this->ShowAll($product->categories);
    }
}
