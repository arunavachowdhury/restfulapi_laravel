<?php

namespace App\Http\Controllers\Buyer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use App\Product;
use App\Transaction;
use App\Buyer;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Transformers\TransactionTransformer;


class BuyerProductTransactionController extends ApiController

{
    public function __construct()
    {
        parent:: __construct();
        $this->middleware('transform.input:' . TransactionTransformer::class)->only('store');
    }

    public function store(Request $request, User $buyer, Product $product){
        $ValidateData = [
            'quantity' => 'required|integer|min:1'
        ];
        $this->validate($request,$ValidateData);

        if($buyer->id == $product->seller_id)
        {
            return $this->Error('Buyer should be diffrent from seller',409);
        }
        if(!$buyer->isVarified())
        {
            return $this->Error('User must be varified',409);
        }
        if(!$product->seller->isVarified())
        {
            return $this->Error('The seller of the product is not varified',409);
        }
        if(!$product->isAvaliable())
        {
            return $this->Error('The product is not avaliable',409);
        }
        if($product->quantity < $request->quantity)
        {
            return $this->Error('The product does not have enough quantity',409);
        }

        return DB::transaction(function() use ($request, $buyer, $product)
        {
            $product->quantity -= $request->quantity;
            $product->save();

            $transaction = Transaction::create([
                'quantity' => $request->quantity,
                'buyer_id' => $buyer->id,
                'product_id' => $product->id
            ]);
            return $this->ShowOne($transaction);
        });
    }
}
