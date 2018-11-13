<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\ApiController;
use App\Seller;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\HttpException;


class SellerProductController extends ApiController
{
    public function index(Seller $seller)
    {
        $products = $seller->products;
        return $this->ShowAll($products);
    }

    public function store(Request $request, Seller $seller)
    {
        $ValidateData = [
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required|integer|min:1',
            'image' => 'required|image'
        ];
        $this->validate($request,$ValidateData);
        $data = $request->all();
        $data['status'] = Product::UNAVALIABLE_PRODUCT;
        $data['image'] = $request->image->store('');
        $data['seller_id'] = $seller->id;   

        $product = Product::create($data);
        return $this->ShowOne($product);
    }

    public function update(Request $request, Seller $seller, Product $product)
    {
        $ValidateData = [
            'quantity' => 'integer|min:1',
            'status' => 'in:' . Product::UNAVALIABLE_PRODUCT . ',' .  Product::AVALIABLE_PRODUCT,
            'image' => 'image' 
        ];
        $this->validate($request,$ValidateData);
        $this->checkSeller($seller, $product);
         if($request->has('name'))
        {
            $product->name = $request->name;
        }
        if($request->has('description'))
        {
            $product->description = $request->description;
        }
        if($request->has('quantity'))
        {
            $product->quantity = $request->quantity;
        }
        if($request->has('status'))
        {
            $product->status = $request->status;
            if($product->isAvaliable() && $product->categories()->count() == 0)
            {
                return $this->Error('An avaliable product must be atlist one category',409);
            }
        }
        if($request->hasFile('image'))
        {
            Storage::delete($product->image);
            $product->image = $request->image->store('');
        }
        if(!$product->isDirty())
        {
            return $this->Error('You need to change any value',422);
        }
        $product->save();
        return $this->ShowOne($product);
    }
    
    public function destroy(Seller $seller, Product $product)
    {
        $this->checkSeller($seller, $product);
        $product->delete();
        Storage::delete($product->image);
        return $this->ShowOne($product);
    }

    public function checkSeller(Seller $seller, Product $product)
    {
        if($seller->id != $product->seller_id)
        {
            throw new \Symfony\Component\HttpKernel\Exception\HttpException(422, "The specified seller is not the actual seller of the product");
        }
    }
}
